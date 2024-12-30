document.addEventListener("DOMContentLoaded", () => {
    const category = document.getElementById("Category");
    const categoryInner = document.getElementById("CategoryInner");
    const prev = document.getElementById("prev");
    const next = document.getElementById("next");

    let isDragging = false;
    let startX = 0;
    let scrollLeft = 0;

    // Update tombol visibility
    const updateButtonsVisibility = () => {
        const maxScrollLeft = categoryInner.scrollWidth - category.offsetWidth;
        prev.classList.toggle("hidden", category.scrollLeft <= 0);
        next.classList.toggle(
            "hidden",
            Math.ceil(category.scrollLeft) >= maxScrollLeft
        );
    };

    // Scroll dengan tombol
    const scrollCategory = (direction) => {
        const scrollAmount = 400; // Sesuaikan jarak scroll
        category.scrollBy({
            left: direction === "next" ? scrollAmount : -scrollAmount,
            behavior: "smooth",
        });
    };

    // Event listener drag (mouse)
    category.addEventListener("mousedown", (e) => {
        isDragging = true;
        startX = e.pageX - category.offsetLeft;
        scrollLeft = category.scrollLeft;
        category.classList.add("cursor-grabbing");
    });

    category.addEventListener("mouseleave", () => {
        isDragging = false;
        category.classList.remove("cursor-grabbing");
    });

    category.addEventListener("mouseup", () => {
        isDragging = false;
        category.classList.remove("cursor-grabbing");
    });

    category.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - category.offsetLeft;
        const walk = (x - startX) * 1.5; // Adjust speed
        category.scrollLeft = scrollLeft - walk;
        updateButtonsVisibility();
    });

    // Event listener drag (touch)
    category.addEventListener("touchstart", (e) => {
        isDragging = true;
        startX = e.touches[0].pageX - category.offsetLeft;
        scrollLeft = category.scrollLeft;
    });

    category.addEventListener("touchend", () => {
        isDragging = false;
    });

    category.addEventListener("touchmove", (e) => {
        if (!isDragging) return;
        const x = e.touches[0].pageX - category.offsetLeft;
        const walk = (x - startX) * 1.5; // Adjust speed
        category.scrollLeft = scrollLeft - walk;
        updateButtonsVisibility();
    });

    // Event listener untuk tombol
    next.addEventListener("click", () => scrollCategory("next"));
    prev.addEventListener("click", () => scrollCategory("prev"));

    // Inisialisasi tombol visibility
    category.addEventListener("scroll", updateButtonsVisibility);
    updateButtonsVisibility();
});
