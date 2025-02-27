document.addEventListener("DOMContentLoaded", () => {
    const toggleBtns = document.querySelectorAll(".toggle-btn")
    const slider = document.querySelector(".slider")
    const joinForm = document.querySelector(".join-form")
    const createForm = document.querySelector(".create-form")
    const card = document.querySelector(".card")

    // Add hover effect to card
    document.addEventListener("mousemove", (e) => {
    const cardRect = card.getBoundingClientRect()
    const cardCenterX = cardRect.left + cardRect.width / 2
    const cardCenterY = cardRect.top + cardRect.height / 2

    const mouseX = e.clientX
    const mouseY = e.clientY

    const rotateY = (mouseX - cardCenterX) / 20
    const rotateX = (cardCenterY - mouseY) / 20

    card.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg)`
    })

    // Reset card rotation when mouse leaves
    document.addEventListener("mouseleave", () => {
    card.style.transform = "rotateY(0) rotateX(0)"
    })

    // Toggle between forms
    toggleBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
        const target = this.dataset.target

        // Update toggle buttons
        toggleBtns.forEach((b) => b.classList.remove("active"))
        this.classList.add("active")

        // Move slider
        if (target === "join") {
            slider.style.left = "5px"
        } else {
            slider.style.left = "calc(50% + 0px)"
        }

        // Toggle forms with animation
        if (target === "join") {
            createForm.classList.remove("active")
            setTimeout(() => {
        joinForm.classList.add("active")
            }, 300)
        } else {
            joinForm.classList.remove("active")
            setTimeout(() => {
        createForm.classList.add("active")
            }, 300)
        }
    })
    })

    // Add input animations
    const inputs = document.querySelectorAll("input")

    inputs.forEach((input) => {
    input.addEventListener("focus", function () {
        this.parentElement.classList.add("focused")
        animateIcon(this.previousElementSibling)
    })

    input.addEventListener("blur", function () {
        this.parentElement.classList.remove("focused")
    })
    })

    function animateIcon(icon) {
    icon.style.transform = "translateY(-50%) scale(1.2)"
    icon.style.color = "var(--primary-color)"

    setTimeout(() => {
        icon.style.transform = "translateY(-50%) scale(1)"
        icon.style.color = "var(--text-light)"
    }, 300)
    }

    // Button hover effects
    const buttons = document.querySelectorAll(".submit-btn")

    buttons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
        this.querySelector("i").style.transform = "translateX(5px)"
    })

    button.addEventListener("mouseleave", function () {
        this.querySelector("i").style.transform = "translateX(0)"
    })

    button.addEventListener("click", function () {
        this.classList.add("clicked")

        // Add ripple effect
        const ripple = document.createElement("span")
        ripple.classList.add("ripple")
        this.appendChild(ripple)

        const rect = this.getBoundingClientRect()
        const size = Math.max(rect.width, rect.height)

        ripple.style.width = ripple.style.height = `${size}px`
        ripple.style.left = `${event.clientX - rect.left - size / 2}px`
        ripple.style.top = `${event.clientY - rect.top - size / 2}px`

        setTimeout(() => {
            ripple.remove()
        }, 600)
    })
    })

    // Add floating animation to decorative elements
    const decorElements = document.querySelectorAll(".circle, .square")

    decorElements.forEach((elem) => {
    const randomX = Math.random() * 20 - 10
    const randomY = Math.random() * 20 - 10
    const randomDelay = Math.random() * 2

    elem.style.animation = `float 8s ease-in-out ${randomDelay}s infinite`
    })
})

