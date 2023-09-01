(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner();

    // Initiate the wowjs
    new WOW().init();

    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 45) {
                $(".fixed-top").addClass("bg-white shadow");
            } else {
                $(".fixed-top").removeClass("bg-white shadow");
            }
        } else {
            if ($(this).scrollTop() > 45) {
                $(".fixed-top").addClass("bg-white shadow").css("top", -45);
            } else {
                $(".fixed-top").removeClass("bg-white shadow").css("top", 0);
            }
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        loop: true,
        center: true,
        dots: false,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>',
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });

    const callAjax = () => {

        $.ajax({
            url: "api/getData.php",
            method: "POST",
            data: {
                search_str: $("#search_medicine").val()
            },
            success: (res) => {
                res = JSON.parse(res);
                if (res.success) {
                    const data = res.data;
                    let content = "";
                    if (data.length) {
                        for (let medicine of data) {
                            content += `<a href='${"/medicine/about.php?m_id=" + medicine.id}'><li class='list-group-item'><img src='/medicine${medicine.photo}' alt='medicine image' width="30" class='me-4' />${medicine.medicine_name}</li></a>`;
                        }
                    } else {
                        content = "<li class='list-group-item text-center text-primary'>No data found!</li>";
                    }
                    $("#search_output").html(content);
                } else {
                    console.log(res.error);
                }
            },
            error: (err) => {
                console.log(err);
            }
        })
    }

    const debounce = (func, delay) => {
        let debounceTimer;
        return function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(func, delay);
        };
    };

    $("#search_medicine").on("input", debounce(callAjax, 500));

})(jQuery);
