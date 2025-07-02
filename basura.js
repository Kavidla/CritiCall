window.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    let current = 2;

    function updateSlider() {
        slides.forEach((slide, index) => {
            slide.className = "slide";

            if (index === current) {
                slide.classList.add("center");
            } else if (index === current - 1) {
                slide.classList.add("left1");
            } else if (index === current - 2) {
                slide.classList.add("left2");
            } else if (index === current + 1) {
                slide.classList.add("right1");
            } else if (index === current + 2) {
                slide.classList.add("right2");
            }
        });
    }

    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight" && current < slides.length - 1) {
            current++;
            updateSlider();
        } else if (e.key === "ArrowLeft" && current > 0) {
            current--;
            updateSlider();
        }
    });

    document.addEventListener("wheel", (e) => {
        if (e.deltaY > 0 && current < slides.length - 1) {
            current++;
        } else if (e.deltaY < 0 && current > 0) {
            current--;
        }
        updateSlider();
    });

    updateSlider();
});
