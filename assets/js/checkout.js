const getProductsLocalStorage = () => {
  const productos = window.localStorage.getItem("carritoJoyeria");
  return !productos ? null : JSON.parse(productos);
};

const renderProducts = async ({ products }) => {
  const productsContainer = document.getElementById("products_container");
  if (!products || products.length === 0) {
    productsContainer.innerHTML = "";
    return;
  }

  const __ELEMENTOS__ = products.map((producto) => ItemComponent({ producto }));
  const _TOTAL_ = await calcularTotal();

  productsContainer.innerHTML = [...__ELEMENTOS__, ..._TOTAL_].join("");
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

const loadProductos = async () => {
  const products = await obtenerProductos();
  renderProducts({ products });
};

const ItemComponent = ({ producto }) => {
  const { id, imagen, nombre, precio, cantidad } = producto;

  const total = (precio * cantidad).toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  return `
    <tr>
        <td>${nombre} <strong class="mx-2">x</strong> ${cantidad}</td>
        <td>${total}</td>
    </tr>`;
};

const Payment = async () => {
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
          '<a style="color: #212529;" href="/pages/client/shop.php">¿Quieres agregar algunos?</a>',
      });
      return;
    }

    console.log("nice");
    //Hacer la peticion
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

  const formatedSubtotal = subtotal.toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  const total = (subtotal + subtotal * 0.1).toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  console.log(subtotal + subtotal * 0.1);

  return [
    `
    <tr>
        <td class="text-black font-weight-bold"><strong>Subtotal del carrito</strong></td>
        <td id="subtotal" class="text-black">${formatedSubtotal}</td>
    </tr>`,
    `
    <tr>
        <td class="text-black font-weight-bold"><strong>Total del pedido</strong></td>
        <td id="total" class="text-black font-weight-bold"><strong>${total}</strong></td>
    </tr>`,
  ];
};

window.addEventListener("load", loadProductos);
