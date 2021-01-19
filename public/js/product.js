tinymce.init({
  selector:'textarea',
  height:250,
  width:'100%',
  theme:'modern',
  resize:false,
  plugins: "link image code fullscreen paste",
});

$(document).ready(function() {
  $('.tag-chips').material_chip(); 
  $('.category-chips').material_chip();  
  
  $('#product-form').on('submit', function(e) {
    var tags = $('.tag-chips').material_chip('data');
    var categories = $('.category-chips').material_chip('data'); 
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    swal("Adding product..",{
      buttons:false,
      closeOnClickOutside:false,
      icon:"info"
    });
    $.ajax({
      url: url+'/product/create',
      method: 'POST',
      data: formData,
      contentType: false,
      cache: false,
      processData: false
    }).done(function(res) {
      console.log(res);
      for(var x in tags) {
        $.post('http://localhost:8000/product-tags/create', {
          'tag': tags[x].tag,
          'product_id':res.product.id,
          '_token':$('input[name=_token]').val()
        }).done(function(res) {
          // console.log(res);
        }).fail(function(err) {
          console.log(err);
        });
      }/* tags post */
      for(var x in categories) {
        $.post('http://localhost:8000/product-category/create', {
          'category':categories[x].tag,
          'product_id':res.product.id,
          '_token':$('input[name=_token]').val()
        }).done(function(res) {
          // console.log(res);
        }).fail(function(err) {
          console.log(err)
        });
      }/* category post */
      $('input[type=text], input[type=number], textarea').val('');
      swal("Success",{
        icon:'success',
        text: res.product.name+" added to store products"
      });
    }).fail(function(err) {
      console.log(err);
      swal("Failed to add product",{
        icon:'error',
        text: "Failed to add product"
      });
      for(var x in err.responseJSON.errors) {
        Materialize.toast(err.responseJSON.errors[x],10000,'red');
      }
    });/* product post */

  });/* product-form on submit */
    
});

$(document).ready(function() {
  
  $('.update-tag-chips').material_chip(); 
  $('.update-category-chips').material_chip();  

  $('#updateProductForm').on('submit', function(e) {
    e.preventDefault();
    var tagData = $('.update-tag-chips').material_chip('data');
    var categoryData = $('.update-category-chips').material_chip('data');
    var formData = new FormData($(this)[0]);
    var loader = document.createElement('div');
    loader.innerHTML = `
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-green-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    `;
    swal({
      buttons:false,
      closeOnClickOutside:false,
      content:loader,
      title:"Updating product.."
    });
    $('#editProduct').modal('close');
    $.ajax({
      url:url+'/product/update/id='+id,
      type:'POST',
      data: formData,
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false
    }).done(function(res) {
      for(var x in tagData) {
        $.post(url+'/product-tags/create',{
          'product_id':id,
          'tag': tagData[x].tag,
          '_token':token
        }).done(function(res) {
          // console.log(res);
        }).fail(function(err) {
          console.log(err);
        }); 
      }/* saving product tags */

      for(var x in categoryData) {
        $.post(url+'/product-category/create',{
          'product_id':id,
          'category':categoryData[x].tag,
          '_token':token
        }).done(function(res) {
          // console.log(res);
        }).fail(function(err) {
          console.log(err);
        });
      }/* saving product categories */

      $.ajax({
        type:'GET',
        url:url+'/product/find/id='+id,
        dataType:'JSON'
      }).done(function(res) {
        console.log(res);
        swal(res.product.name,'Item updated','success');
      });/* get updated product */
      
    }).fail(function(err) {
      console.log(err);
      $('#editProduct').modal('open');
      swal("Error",{
        icon:'error',
        text: "Failed to update product"
      });
      for(var x in err.responseJSON.errors) {
        Materialize.toast(err.responseJSON.errors[x],10000,'red');
      }
    });/* update form failed */
  });/* update form submit */

});/* document.ready */

function findProduct($id) {
  $('.chip').each(function() {
    $(this).remove();
  });
  $.ajax({
    url:url+'/product/find/id='+$id,
    type:'GET'
  }).done(function(res) {
    id = res.product.id;
    $('#name').val(res.product.name);
    $('#type').val(res.product.type);
    $(tinymce.get('description').getBody()).html(``+ res.product.description +``);
    $('#quantity').val(res.product.quantity);
    $('#original_price').val(res.product.original_price);
    $('#srp').val(res.product.srp);
    $('#delivery_fee').val(res.product.delivery_fee);
    $('#warranty').val(res.product.warranty);
    $('#discount').val(res.product.discount);
    $('.update-tag-chips').material_chip({
      data: res.tags
    });
    var categoryArr = [];
    for(var x in res.categories) {
      categoryArr.push({
        tag:res.categories[x].category
      });
    }
    $('.update-category-chips').material_chip({
      data:categoryArr
    });

  }).fail(function(err) {
    console.log(err);
  });
}

function deleteProduct($sid) {
  swal({
    title: "Are you sure ?",
    text: "The selected blog will be deleted",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if(willDelete) {
        $.ajax({
          url: url+'/product/delete/'+$sid,
          type:'DELETE',
          data: {
            '_token':$('input[name=_token]').val()
          }
        }).done(function(res) {
          $(`#prod_`+ $sid +``).remove();
          swal("Product removed",{ icon:"success" });
          console.log(res);
        }).fail(function(err) {
          Materialize.toast("Failed to remove product",2000,'red');
          console.log(err);
        });
    }else {

    }/* if Willdelete*/
  });
}

function viewProduct(id) {
  $.ajax({
    type:'GET',
    url:url+'/product/find/id='+id
  }).done(function(res) {
    console.log(res)
    var images = [];    
    var tags = [];
    var categories = [];
    for(var x in res.images) {
      images.push(`<img src="/storage/images/product_images/${res.product.id}/${res.images[x].image}" style="width:20%" class="cicle"> `);
    }
    for(var x in res.tags) {
      tags.push(`<a href="${url}/product/tag/${res.tags[x].tag}" target=_blank>${res.tags[x].tag}</a>`)
    }
    for(var x in res.categories) {
      categories.push(`<a href="${url}/product/cetegory/${res.categories[x].category}" target=_blank>${res.categories[x].category}</a>`)
    }
    console.log(images);
    var productContent = document.createElement('div')
    productContent.innerHTML = `
      <div class='center'>
        <h5>${res.product.name}</h5>
        <div>
          ${images}
        </div>
        <h5>₱ ${res.discount}.00</h5>
        <strike>₱ ${res.product.original_price}.00</strike> -${res.product.discount} off
        <p>${res.product.description}</p>
        Tags: ${tags}
        Categories: ${categories}
      </div>
    `;
    swal({
      content:productContent
    })
  }).fail(function(err) {
    console.log(err);
  })
}