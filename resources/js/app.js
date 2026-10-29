import Alpine from "alpinejs";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import yearSelectPlugin from "@mikesha/flatpickr-year-select-plugin";

// Daftarkan Flatpickr & Plugin ke window agar bisa dipanggil dari Blade
window.flatpickr = flatpickr;
window.yearSelectPlugin = yearSelectPlugin;

// Inisialisasi Store Alpine.js
document.addEventListener("alpine:init", () => {
  // 1. Store untuk Toast Notifications
  Alpine.store("toasts", {
    items: [],
    add({ title, message, type = "info", duration = 3500 }) {
      const id = Date.now() + Math.random();
      this.items.push({ id, title, message, type });
      setTimeout(() => this.remove(id), duration);
    },
    remove(id) {
      this.items = this.items.filter((t) => t.id !== id);
    },
  });

  // 2. Store untuk Theme Toggle (Dark/Light Mode)
  Alpine.store("theme", {
    current: localStorage.getItem("theme") || "system",
    set(mode) {
      this.current = mode;
      localStorage.setItem("theme", mode);

      // Logika ganti class 'dark' di tag <html>
      if (
        mode === "dark" ||
        (mode === "system" &&
          window.matchMedia("(prefers-color-scheme: dark)").matches)
      ) {
        document.documentElement.classList.add("dark");
      } else {
        document.documentElement.classList.remove("dark");
      }
    },
  });
});

// Daftarkan Alpine ke window & jalankan
window.Alpine = Alpine;
Alpine.start();
