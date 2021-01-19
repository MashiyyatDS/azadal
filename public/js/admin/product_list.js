$(document).ready(function() {
  getProductList();
});

/*============ GET PRODUCT LIST ==============*/
var productPage = 1;
function getProductList() {
  swal({
    title:"Getting Products Data",
    content:loader,
    button:false
  });
  $.ajax({
    type:'GET',
    url:url+'/admin/product-list/json'
  }).done(function(res) {
    productPage = productPage + 1;
    swal.close();
    for(var x in res.product.data) {
      $('#product-container').append(`
        <tr class="product-row" id="${res.product.data[x].id}">
          <td>${res.product.data[x].name}</td>
          <td>₱ ${res.product.data[x].original_price}.00</td>
          <td>- ${res.product.data[x].discount}% off</td>
          <td>₱ ${res.product.data[x].delivery_fee}.00</td>
          <td>${res.product.data[x].store.name}</td>
          <td>
            <button class="btn-flat waves-effect waves-light white-text red" onclick="removeProduct(${res.product.data[x].id})">
              <span class="fa fa-trash"></span>
            </button>
          </td>
        </tr>
      `).hide().fadeIn(200);  
    }
    if (res.product.total > 10) {
      $('#view-more-container').append(`
        <button class="btn-flat waves-effect waves-light white-text blue" id="view-more-products" onclick="viewMoreProducts()">
          View more
        </button>
      `);
    }
    console.log(res.product.total);
  }).fail(function(err) {
    console.log(err);
  });
}

/*============ VIEW MORE PRODUCT LIST ==============*/
function viewMoreProducts() { 
	swal({
		title:"Getting Products Data",
    content:loader,
    button:false
	});

	$.ajax({
		type:'GET',
		url:url+'/admin/product-list/json?page='+productPage
	}).done(function(res) {
    productPage = productPage + 1;
		if(jQuery.isEmptyObject(res.product.data)) {
			swal({title:"All products loaded",icon:'info'});
		}
		for(var x in res.product.data) {
      $('#product-container').append(`
        <tr class="product-row" id="${res.product.data[x].id}">
          <td>${res.product.data[x].name}</td>
          <td>₱ ${res.product.data[x].original_price}.00</td>
          <td>- ${res.product.data[x].discount}% off</td>
          <td>₱ ${res.product.data[x].delivery_fee}.00</td>
          <td>${res.product.data[x].store.name}</td>
          <td>
            <button class="btn-flat waves-effect waves-light white-text red" onclick="removeProduct(${res.product.data[x].id})">
              <span class="fa fa-trash"></span>
            </button>
          </td>
        </tr>
      `).hide().fadeIn(200);  
    }
		swal.close();
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	})
}

/*============ REMOVE PRODUCT FROM LIST ==============*/
function removeProduct(id) {
  swal({
    title: "Are you sure ?",
    text: "The selected product will be remove",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willRemove) => {
    if (willRemove) {
      $.ajax({
        type:'PUT',
        url:url+'/admin/product/remove/'+id,
        data: {
          _token:token
        }
      }).done(function(res) {
        $('.product-row').remove()
        $('.searched-data').remove()
        $('#searchedListViewMore').remove()
        Materialize.toast("Product removed",2000);
        $('#view-more-products').remove();
        getProductList();
      }).fail(function(err) {
        console.log(err);
      }) 
    }
  })/* THEN WILL REMOVE */
}

/* ================== SEARCH PRODUCT ================== */
var searchProductListPage = 1;
var searchData = ''
$(document).ready(function() {
  $('#search-product-list').on('click', function() {
    swal({
      title:'Search product',
      content:'input'
    }).then((value) => {
      swal({
        content:loader,
        title:"Searching product...",
        button:false
      });
      $.ajax({
        type:'GET',
        url:url+'/admin/product-list/search='+value
      }).done(function(res) {
        swal.close();
        searchData = value;
        $('.searched-data').remove()
        $('#searchedListViewMore').remove()
        searchProductListPage = searchProductListPage + 1;
        for(var x in res.product.data) {
          $('#searched-product-container').append(`
            <tr class="searched-data">
              <td>${res.product.data[x].name}</td>
              <td>₱ ${res.product.data[x].original_price}.00</td>
              <td>- ${res.product.data[x].discount}% off</td>
              <td>₱ ${res.product.data[x].delivery_fee}.00</td>
              <td>${res.product.data[x].store.name}</td>
              <td>
                <button class="btn-flat waves-effect waves-light white-text red" onclick="removeProduct(${res.product.data[x].id})">
                  <span class="fa fa-trash"></span>
                </button>
              </td>
            </tr>
          `).hide().fadeIn(200);  
        }
        if (res.product.total > 10) {
          $('#view-more-search-list').append(`
            <button class="btn-flat waves-effect waves-light white-text blue" id="view-more-products" onclick="viewMoreSearchedProducts()">
              View more
            </button>
          `);
        }
        console.log(res);
      }).fail(function(err) {
        console.log(err);
      });
    });
  });
});

/*============ VIEW MORE SEARCH PRODUCT ==============*/
var viewMoreListPage = 2;
function viewMoreSearchedProducts() {
  $.ajax({
    type:'GET',
    url:url+'/admin/product-list/search='+searchData+'?page='+viewMoreListPage
  }).done(function(res) {
    if(jQuery.isEmptyObject(res.product.data)) {
      swal({title:"All products loaded",icon:'info'});
    }
    for(var x in res.product.data) {
      $('#searched-product-container').append(`
        <tr class="searched-data">
          <td>${res.product.data[x].name}</td>
          <td>₱ ${res.product.data[x].original_price}.00</td>
          <td>- ${res.product.data[x].discount}% off</td>
          <td>₱ ${res.product.data[x].delivery_fee}.00</td>
          <td>${res.product.data[x].store.name}</td>
          <td>
            <button class="btn-flat waves-effect waves-light white-text red" onclick="removeProduct(${res.product.data[x].id})">
              <span class="fa fa-trash"></span>
            </button>
          </td>
        </tr>
      `).hide().fadeIn(200);  
    }
    $('#searched-product-container')
    viewMoreListPage = viewMoreListPage + 1;
    console.log(res);
  }).fail(function(err) {
    console.log(err);
  });
}