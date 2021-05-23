///////////////////////////////////////////////////////////////////////////////////////////////////
fetch_brand_data();

/*Function that fetches data for brands*/
function fetch_brand_data() {
    $.ajax({
        url: "fetchbrand.php",
        type: "POST",
        success: function(html) {
            $('#content').html(html);
        }
    });
}
//////////////////////////////////////////////////////////////////////////////////////////////////////

/*Append HTML data to Brand Table in HTML*/
$('#add').click(function() {
    var html = '<tr>';
    html += '<td contenteditable id="brandname">Edit here</td>';
    html += '<td></td>';
    html +=
        '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
    html += '</tr>';
    $('#brand_table tbody').prepend(html);
});
////////////////////////////////////////////////////////////////////////////////////////////////////

/*Sends data to inserbrand.php to add a new brand to brand table*/
$(document).on('click', '#insert', function() {
    var brandname = $("#brandname").text(); /*Gets new brand name*/
    console.log(brandname);
    /*Check if brand name is empty or valid*/
    if (brandname === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please insure that the brand is not empty.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else if (brandname === 'Edit here') {
        $.toast({
            heading: 'Warning',
            text: 'Please add a valid brand.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.ajax({
            url: "insertbrand.php",
            method: "POST",
            data: {
                brandname: brandname
            },
            success: function(data) {
                if (data === 'successful') {
                    $.toast({
                        heading: 'Success',
                        text: 'Brand has been added',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                    $('#brand_table').DataTable().destroy();
                    fetch_brand_data();
                }
                if (data === 'unsuccessful') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Unable to add brand',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                    $('#brand_table').DataTable().destroy();
                    fetch_brand_data();
                }
            }
        });
    }

    /////////////////////////////////////////////////////////////////////////////////////////
});
////////////////////////////////////////////////////////////////////////////////////////////////

/**Discontinue brand */
$(document).on("click", ".delete", function() {
    var id = $(this).attr("id");
    console.log(id);
    swal.fire({
            text: 'Every item related to this brand will be discontinued. Are you sure you want to discontinue this brand?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: "deletebrand.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data === 'successful') {
                            $.toast({
                                heading: 'Success',
                                text: 'Brand discontinued successfully.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });
                            $('#brand_table').DataTable().destroy();
                            fetch_brand_data();
                        }
                        if (data === 'unsuccessful') {
                            $.toast({
                                heading: 'Warning',
                                text: 'Operation unsuccessful.',
                                showHideTransition: 'slide',
                                icon: 'warning',
                                loaderBg: '#57c7d4',
                                position: 'top-right'
                            });
                            $('#brand_table').DataTable().destroy();
                            fetch_brand_data();
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                $('#brand_table').DataTable().destroy();
                fetch_brand_data();
            }
        });

});
//////////////////////////////////////////////////////////////////////////////////////////////

/**Continue brand that has been discontinued */
$(document).on("click", ".continue", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "continuebrand.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            if (data === 'successful') {
                $.toast({
                    heading: 'Success',
                    text: 'Brand continued successfully.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
                $('#brand_table').DataTable().destroy();
                fetch_brand_data();
            }
            if (data === 'unsuccessful') {
                $.toast({
                    heading: 'Warning',
                    text: 'Operation unsuccessful.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                });
                $('#brand_table').DataTable().destroy();
                fetch_brand_data();
            }
        }
    });

});
/**Continue brand that has been discontinued */
$(document).on("click", ".continuebrand", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "continuebrand.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            if (data === 'successful') {
                $.toast({
                    heading: 'Success',
                    text: 'Brand continued successfully.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
                window.location.href = 'inventory.php';
            }
            if (data === 'unsuccessful') {
                $.toast({
                    heading: 'Warning',
                    text: 'Operation unsuccessful.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                });
                window.location.href = 'inventory.php';
            }
        }
    });

});
////////////////////////////////////////////////////////////////////////////////////////////

/**Category */

fetch_category_data();

/*Fetching data for category*/
function fetch_category_data() {
    $.ajax({
        url: "fetchcat.php",
        type: "POST",
        success: function(html) {
            $('#contentcat').html(html);
        }
    });
}
////////////////////////////////////////////////////////////////////////////////////////////

/*Append HTML data to Category Table in HTML*/
$('#addcat').click(function() {
    var html = '<tr>';
    html += '<td contenteditable id="catname">Edit here</td>';
    html += '<td></td>';
    html +=
        '<td><button type="button" name="insertcat" id="insertcategory" class="btn btn-success btn-xs">Insert</button></td>';
    html += '</tr>';
    $('#cat_table tbody').prepend(html);
});
//////////////////////////////////////////////////////////////////////////////////////////

/*Sends data to insercat.php to add a new category to category table*/
$(document).on('click', '#insertcategory', function() {
    var catname = $("#catname").text();
    console.log(catname);

    if (catname === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please insure that the category is not empty.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else if (catname === 'Edit here') {
        $.toast({
            heading: 'Warning',
            text: 'Please add a valid category.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.ajax({
            url: "insertcat.php",
            method: "POST",
            data: {
                catname: catname
            },
            success: function(data) {
                if (data === 'successful') {
                    $.toast({
                        heading: 'Success',
                        text: 'Brand has been added',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                    $('#cat_table').DataTable().destroy();
                    fetch_category_data();
                }
                if (data === 'unsuccessful') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Unable to add brand',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                    $('#cat_table').DataTable().destroy();
                    fetch_category_data();
                }
            }
        });
    }
});
////////////////////////////////////////////////////////////////////////////////////////////

/**Opens brand to discontinue for modal and populates it. */
$(document).on("click", ".deletecat", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "selectbrandforcat.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(html) {
            $('.selectdeactivation').html(html);
        }
    });

});
////////////////////////////////////////////////////////////////////////////////////////

/**Discontinue category */
$(document).on("click", "#done", function() {
    var catID = $("#getbrandid").attr("value");
    var getitembrandid = document.getElementById("getitembrand").value;
    console.log(catID);
    console.log(getitembrandid);

    swal.fire({
            text: 'Every item related to this category will be discontinued. Are you sure you want to discontinue this category?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: "deletecat.php",
                    method: "POST",
                    data: {
                        catID: catID,
                        getitembrandid: getitembrandid
                    },
                    success: function(data) {
                        if (data === 'successful') {
                            $.toast({
                                heading: 'Success',
                                text: 'Category discontinued successfully.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });
                            $('#cat_table').DataTable().destroy();
                            fetch_category_data();
                        }
                        if (data === 'unsuccessful') {
                            $.toast({
                                heading: 'Warning',
                                text: 'Operation unsuccessful.',
                                showHideTransition: 'slide',
                                icon: 'warning',
                                loaderBg: '#57c7d4',
                                position: 'top-right'
                            });
                            $('#cat_table').DataTable().destroy();
                            fetch_category_data();
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                $('#cat_table').DataTable().destroy();
                fetch_category_data();
            }
        });

});
///////////////////////////////////////////////////////////////////////////////////////////////

/**Continue Category */
$(document).on("click", ".continuecat", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "continuecat.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            if (data === 'successful') {
                $.toast({
                    heading: 'Success',
                    text: 'Category continued successfully.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
                $('#cat_table').DataTable().destroy();
                fetch_category_data();
            }
            if (data === 'unsuccessful') {
                $.toast({
                    heading: 'Warning',
                    text: 'Operation unsuccessful.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                });
                $('#cat_table').DataTable().destroy();
                fetch_category_data();
            }
        }
    });

});
/**Continue Category */
$(document).on("click", ".continue-cat", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "continuecat.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            if (data === 'successful') {
                window.location.href = 'inventory.php';
            }
            if (data === 'unsuccessful') {
                $.toast({
                    heading: 'Warning',
                    text: 'Operation unsuccessful.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                });
                window.location.href = 'inventory.php';
            }
        }
    });

});
////////////////////////////////////////////////////////////////////////////////////////////////

/**Continue Item */

$(document).on("click", ".continue-item", function() {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "continueitem.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(data) {
            if (data === 'successful') {
                $.toast({
                    heading: 'Success',
                    text: 'Item continued successfully.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
                window.location.href = 'inventory.php';
            }
            if (data === 'unsuccessful') {
                $.toast({
                    heading: 'Warning',
                    text: 'Operation unsuccessful.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                });
                window.location.href = 'inventory.php';
            }
        }
    });

});
////////////////////////////////////////////////////////////////////////////////////////////////


//check regular expression
function checkPattern(elem) {

    var elmt = document.getElementById(elem);
    // Allow A-Z, a-z, 0-9 and underscore. Min 1 char.
    var pattern = elmt.getAttribute("pattern");
    var re = new RegExp(pattern);

    console.log(re);

    if (!re.test(elmt.value) && elmt.value !== '') {
        $.toast({
            heading: 'Warning',
            text: 'Please use correct format',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });

    }
    if (re.test(elmt.value) && elmt.value !== '') {
        $.toast({
            heading: 'Success',
            text: 'Ok',
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });
    }
}

function checkifempty(elem) {
    var elmt = document.getElementById(elem).value;

    if (elmt === '') {
        $.toast({
            heading: 'Warning',
            text: 'Field is empty',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {

    }
}

function checkbrandcombovalue() {
    var brand = document.getElementById("additembrand").value;
    console.log(brand);
    if (brand === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please select an object',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.toast({
            heading: 'Success',
            text: 'Ok',
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });
    }
}

function checkbrandcombovalue() {
    var brand = document.getElementById("getitembrand").value;
    console.log(brand);
    if (brand === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please select an object',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.toast({
            heading: 'Success',
            text: 'Ok',
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });
    }
}

function checkcatcombovalue() {
    var cat = document.getElementById("additemcategory").value;
    console.log(cat);
    if (cat === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please select an object',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.toast({
            heading: 'Success',
            text: 'Ok',
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });
    }
}

//////////////////////////////////////////////////////////////////////////////////////

$('#additem').click(function() {


    var brand = document.getElementById("additembrand").value;
    var category = document.getElementById("additemcategory").value;
    var item = document.getElementById("itemtype").value;
    var quantity = document.getElementById("itemquantity").value;
    var flag = document.getElementById("itemflag").value;
    var price = document.getElementById("itemprice").value;

    if (brand !== '' && category !== '' && item !== '' && quantity !== '' &&
        flag !== '' && price !== '') {

        $.ajax({
            url: 'registeritem.php',
            method: 'post',
            data: {
                brand: brand,
                category: category,
                item: item,
                quantity: quantity,
                flag: flag,
                price: price
            },
            success: function(data) {

                console.log(data);

                if (data === '') {
                    $.toast({
                        heading: 'success',
                        text: 'Registration Successful.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });

                }

                if (data === 'unsuccessful') {
                    $.toast({
                        heading: 'Danger',
                        text: 'Could not register new user. Please try again.',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    });

                }

            }
        });
    } else {
        $.toast({
            heading: 'Warning',
            text: 'Check all fields and try again.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    }
});

////////////////////////////////////////////////////////////////////////////////////////////////////

/**Restock */

$('.restock').click(function() {

    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "restockitem.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(html) {
            $('.restockcontent').html(html);
        }
    });

});

////////////////////////////////////////////////////////////////////////////////////////////

/**Post to database */

$('#restockdone').click(function() {

    var id = document.getElementById('itemNo').getAttribute("name");
    console.log(id);
    var restocknumber = parseInt(document.getElementById('restocknumber').value);
    console.log(restocknumber);
    var flag = parseInt(document.getElementById('flag').value);
    console.log(flag);
    const remainingquantity = parseInt(document.getElementById('remainingquantity').value);
    console.log(remainingquantity);
    var totalquantity = restocknumber + remainingquantity;
    console.log(restocknumber + remainingquantity);

    if (totalquantity <= flag) {
        $.toast({
            heading: 'Warning',
            text: 'Quantity should be greater than flag.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.ajax({
            url: "restockquantity.php",
            method: "POST",
            data: {
                id: id,
                totalquantity: totalquantity
            },
            success: function(data) {
                if (data === 'successful') {
                    window.location.href = 'inventory.php';
                }
                if (data === 'unsuccessful') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Operation unsuccessful.',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });

                }
            }
        });

    }

});

////////////////////////////////////////////////////////////////////////////////////////////////////

/**Edit */

$('.edit-item').click(function() {

    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
        url: "edititem.php",
        method: "POST",
        data: {
            id: id
        },
        success: function(html) {
            $('.editcontent').html(html);
        }
    });

});

////////////////////////////////////////////////////////////////////////////////////////////

/**Post to database */

$('#editdone').click(function() {

    var id = document.getElementById('itemNo').getAttribute("name");
    console.log(id);
    var itemName = document.getElementById('itemNo').value;
    console.log(itemName);
    var price = parseInt(document.getElementById('price').value);
    console.log(price);

    if (price === 0) {
        $.toast({
            heading: 'Warning',
            text: 'Price should be greater than zero.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else if (itemName === '') {
        $.toast({
            heading: 'Warning',
            text: 'Please provide description for this item.',
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        });
    } else {
        $.ajax({
            url: "edititemsPost.php",
            method: "POST",
            data: {
                id: id,
                itemName: itemName,
                price: price
            },
            success: function(data) {
                if (data === 'successful') {
                    window.location.href = 'inventory.php';
                }
                if (data === 'unsuccessful') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Operation unsuccessful.',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });

                }
            }
        });

    }

});

$(document).on("click", ".closemodal", function() {
    window.location.href = 'inventory.php';
});

$(document).on("click", ".closeselect", function() {
    $('#cat_table').DataTable().destroy();
    fetch_category_data();
});