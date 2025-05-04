// script.js
document.addEventListener("DOMContentLoaded", function () {
  const amountButtons = document.querySelectorAll(".amount-button");
  const customNominalInput = document.getElementById("custom_nominal");
  const totalInput = document.getElementById("total");
  const form = document.getElementById("donationForm");

  amountButtons.forEach((button) => {
    button.addEventListener("click", () => {
      customNominalInput.value = "";
      amountButtons.forEach((btn) => btn.classList.remove("selected"));
      button.classList.add("selected");
      totalInput.value = button.getAttribute("data-value");
    });
  });

  customNominalInput.addEventListener("input", () => {
    amountButtons.forEach((btn) => btn.classList.remove("selected"));
    totalInput.value = customNominalInput.value;
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("midtrans/placeOrder.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.snapToken) {
          window.snap.pay(data.snapToken, {
            onSuccess: function (result) {
              alert("Pembayaran berhasil!");
              form.reset();
              totalInput.value = "";
              amountButtons.forEach((btn) => btn.classList.remove("selected"));
            },
            onPending: function (result) {
              alert("Pembayaran tertunda.");
            },
            onError: function (result) {
              alert("Pembayaran gagal.");
            },
            onClose: function () {
              alert("Pembayaran dibatalkan.");
            },
          });
        } else {
          console.error("Data tidak valid:", data);
          alert("Gagal mendapatkan token pembayaran.");
        }
      })
      .catch((err) => {
        console.error("Fetch gagal:", err);
        alert("Terjadi kesalahan saat menghubungi server.");
      });
  });
});
