/*------------------------------------------------------------------
    File Name: custom.js
    Template Name: Pluto - Responsive HTML5 Template
    Created By: html.design
    Envato Profile: https://themeforest.net/user/htmldotdesign
    Website: https://html.design
    Version: 1.0
-------------------------------------------------------------------*/

/*--------------------------------------
  sidebar
--------------------------------------*/

"use strict";

$(document).ready(function () {
    /*-- sidebar js --*/
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    /*--------------------------------------
        scrollbar js
    --------------------------------------*/

    var ps = new PerfectScrollbar('#sidebar');
    const callViewAjax = () => {
        $.ajax({
            url: "/medicine/api/getData.php",
            method: "POST",
            data: {
                search_str: $("#search-view-medicine").val()
            },
            success: (res) => {
                res = JSON.parse(res);
                if (res.success) {
                    const data = res.data;
                    let content = "";
                    if (data.length) {
                        for (let medicine of data) {
                            content += `
                                <div class="col-lg-3 col-md-6 col-sm-12 pb-4">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:200px;">
                                            <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:200px;" src="${"/medicine" + medicine.photo}" alt="medicine photo">
                                        </div>
                                        <div class="card-body border-left border-right p-2">
                                            <h4 class="text-truncate">${medicine.medicine_name}</h4>
                                            <p style="font-size: 13px; color: black">Category name: ${medicine.category_name}</p>
                                            <p class="text-truncate">${medicine.description}</p>
                                            <h6>₹ ${medicine.mrp}</h6>
                                            <p style="font-size: 10px" class="m-0 p-0">Created At: ${new Date(medicine.packing_date).toLocaleDateString()}</p>
                                            <p style="font-size: 10px" class="m-0 p-0"> ${(medicine.expiry_date ? "Expired At: " + new Date(medicine.expiry_date).toLocaleDateString() : "")}</p >
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    } else {
                        content = "<div class='container py-5 text-center text-secondary'>No data found!</div>";
                    }
                    $("#target-view-div").html(content);
                } else {
                    console.log(res.error);
                }
            },
            error: (err) => {
                console.log(err);
            }
        })
    }

    const callUpdateAjax = () => {
        $.ajax({
            url: "api/update_medicine.php",
            method: "POST",
            data: {
                search_str: $("#search-update-medicine").val()
            },
            success: (res) => {
                $("#target-update-div").html(res);
            },
            error: (err) => {
                console.log(err);
            }
        })
    }

    const callDeleteAjax = () => {
        $.ajax({
            url: "api/delete_medicine.php",
            method: "POST",
            data: {
                search_str: $("#search-delete-medicine").val()
            },
            success: (res) => {
                $("#target-delete-div").html(res);
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

    $("#search-view-medicine").on("input", debounce(callViewAjax, 500));
    $("#search-update-medicine").on("input", debounce(callUpdateAjax, 500));
    $("#search-delete-medicine").on("input", debounce(callDeleteAjax, 500));
});