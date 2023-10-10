const addProduct = (id) => {
  const productos = window.localStorage.getItem("carritoJoyeria");
  if (!productos) {
    const newProducts = JSON.stringify([formatProducts({ id })]);
    localStorage.setItem("carritoJoyeria", newProducts);
    numeroItemCart();
    return;
  }

  const formatedProducts = JSON.parse(productos);
  const item = formatedProducts.filter((x) => x.id == id)[0];

  if (item) {
    const newProduct = formatProducts({ id, cantidad: item.cantidad + 1 });
    const updatedProducts = formatedProducts.map((x) =>
      x.id === newProduct.id ? newProduct : x
    );

    localStorage.setItem("carritoJoyeria", JSON.stringify(updatedProducts));
    mostrarAlerta();
    numeroItemCart();
    return;
  }

  const newProducts = [...formatedProducts, formatProducts({ id })];
  localStorage.setItem("carritoJoyeria", JSON.stringify(newProducts));
  mostrarAlerta();
  numeroItemCart();
};

const formatProducts = ({ id, cantidad = 1 }) => {
  return { id: id, cantidad: cantidad };
};

const mostrarAlerta = () => {
  Swal.fire({
    icon: "success",
    title: "Producto agregado",
    showConfirmButton: false,
    timer: 600,
  });
};

const numeroItemCart = () => {
  const productos = window.localStorage.getItem("carritoJoyeria");
  const numero = productos ? JSON.parse(productos).length : 0;

  const item = document.getElementById("amount_shopping");
  item.innerHTML = numero;
};

window.addEventListener("load", numeroItemCart);
