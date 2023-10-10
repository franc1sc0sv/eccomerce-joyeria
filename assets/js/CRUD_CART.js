const getProductsLocalStorage = () => {
  const productos = window.localStorage.getItem("carritoJoyeria");
  return !productos ? null : JSON.parse(productos);
};

const updateLocalStorage = ({ products }) => {
  localStorage.setItem("carritoJoyeria", JSON.stringify(products));
};

const renderProducts = ({ products }) => {
  const productsContainer = document.getElementById("products_container");
  const errrorElement = document.getElementById("message");

  if (!products || products.length === 0) {
    errrorElement.innerHTML =
      "Actualmente no hay productos agregados al carrito";
    productsContainer.innerHTML = "";
    return;
  }

  productsContainer.innerHTML = products
    .map((producto) => ItemComponent({ producto }))
    .join("");
};

const obtenerProductos = async () => {
  const productos = getProductsLocalStorage();

  if (!productos || productos.length === 0) {
    return [];
  }
  const idsArray = productos.map((item) => item.id);

  const url = "../../controllers/obtenerProductos.php";
  const params = `productos=${JSON.stringify(idsArray)}`;

  const response = await fetch(`${url}?${params}`);
  const data = await response.json();

  return data.map((producto) => {
    const item = productos.filter((item) => item.id === producto.id);

    return {
      ...producto,
      cantidad: item[0].cantidad,
    };
  });
};

const loadCarrito = async () => {
  const products = await obtenerProductos();
  renderProducts({ products });
  calcularTotal();
  numeroItemCart();
};

const ItemComponent = ({ producto }) => {
  const { id, imagen, nombre, precio, cantidad } = producto;

  const total = (precio * cantidad).toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  return `<tr>
    <td class="product-thumbnail">
      <img style="height: 100px;" src="/uploads/${imagen}" alt="Image" class="img-flui{d" />
    </td>
    <td class="product-name">
      <h2 class="h5 text-black">${nombre}</h2>
    </td>
    <td>$${precio}</td>
    <td>
      <div class="input-group mb-3" style="max-width: 120px">
        <div class="input-group-prepend">
          <button onclick="minusProduct(${id})" class="btn btn-outline-primary js-btn-minus" type="button">
            &minus;
          </button>
        </div>
        <input type="text" class="form-control text-center" value="${cantidad}" placeholder=""
          aria-label="Example text with button addon" aria-describedby="button-addon1" />
        <div class="input-group-append">
          <button onclick="plusProduct(${id})" class="btn btn-outline-primary js-btn-plus" type="button">
            &plus;
          </button>
        </div>
      </div>
    </td>
    <td>${total}</td>
    <td>
      <p onclick="deleteProduct(${id})" class="btn btn-primary height-auto btn-sm">X</p>
    </td>
  </tr>`;
};

const minusProduct = (id) => {
  const products = getProductsLocalStorage();
  const selectedProduct = products?.filter((item) => item.id === id)[0];

  if (selectedProduct.cantidad - 1 === 0) return;

  const formatedProduct = formatProducts({
    id: selectedProduct.id,
    cantidad: selectedProduct.cantidad - 1,
  });

  const updatedProducts = products.map((x) =>
    x.id === formatedProduct.id ? formatedProduct : x
  );
  updateLocalStorage({ products: updatedProducts });
  loadCarrito();
};

const plusProduct = (id) => {
  const products = getProductsLocalStorage();
  const selectedProduct = products?.filter((item) => item.id === id)[0];

  const formatedProduct = formatProducts({
    id: selectedProduct.id,
    cantidad: selectedProduct.cantidad + 1,
  });

  const updatedProducts = products.map((x) =>
    x.id === formatedProduct.id ? formatedProduct : x
  );
  updateLocalStorage({ products: updatedProducts });
  loadCarrito();
};

const deleteProduct = (id) => {
  const productos = getProductsLocalStorage();
  const filteredProducts = productos.filter((x) => x.id !== id);
  updateLocalStorage({ products: filteredProducts });
  loadCarrito();
};

const goCheckOut = async () => {
  try {
    const response = await fetch(`/controllers/estaLogeado.php`);
    const data = await response.json();

    const products = await obtenerProductos();

    if (!data.logeado) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Al parecer no estás logeado!",
        footer:
          '<a style="color: #212529;" href="/pages/login.php">¿Quieres iniciar sesión?</a>',
      });
      return;
    }

    if (!products || products.length === 0) {
      Swal.fire({
        icon: "warning",
        title: "Oops...",
        text: "Al parecer no tienes productos en tu carrito",
        footer:
          '<a style="color: #212529;" href="/pages/client/tienda.php">¿Quieres agregar algunos?</a>',
      });
      return;
    }

    window.location.href = `/pages/client/compra.php`;
  } catch (error) {
    console.error("Error al verificar si el usuario está logeado.", error);
  }
};

const calcularTotal = async () => {
  const productos = await obtenerProductos();
  const subtotalElement = document.getElementById("subtotal");
  const totalElement = document.getElementById("total");

  if (!productos || productos.length === 0) {
    subtotalElement.innerHTML = "$0.00";
    totalElement.innerHTML = "$0.00";
    return;
  }

  const { subtotal } = productos.reduce(
    (acc, producto) => {
      const { precio, cantidad } = producto;
      acc.subtotal += precio * cantidad;
      return acc;
    },
    { subtotal: 0, total: 0 }
  );
  const total = subtotal + subtotal * 0.1;

  subtotalElement.innerHTML = subtotal.toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  totalElement.innerHTML = total.toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });
};

window.addEventListener("load", loadCarrito);
