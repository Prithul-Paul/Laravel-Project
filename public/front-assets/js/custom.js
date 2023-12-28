/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       var lowest = jQuery('#skip-value-lower').data('price');
       var highset = jQuery('#skip-value-upper').data('price');
        noUiSlider.create(skipSlider, {
            range: {
                'min': 100,
                '10%': 400,
                '20%': 700,
                '30%': 1000,
                '40%': 1300,
                '50%': 1600,
                '60%': 1900,
                '70%': 2200,
                '80%': 2500,
                '90%': 2800,
                'max': 3000
            },
            snap: true,
            connect: true,
            start: [400, 2200],
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

    $("div.aa-color-tag a").on("click", function(){
      $("#hidden_color").val($(this).data('color'));
      var image_path = $(this).data('image');
      var image_html = `<a data-lens-image="`+image_path+`" class="simpleLens-lens-image"><img src="`+image_path+`" class="simpleLens-big-image"></a>`;
      $("div.simpleLens-big-image-container").html(image_html);
    });
    $("div.aa-prod-view-size a").on("click", function(e){
      var size = $(this).text();
      $("#hidden_size").val(size);
      $("div.aa-color-tag a.product_color").hide();
      $("div.aa-color-tag a.size_"+size).show();
    });

    $("button#add-to-cart").on("click", function()
    {
      if($("#hidden_size").val() == "")
      {
        var error = "<span>Please select the product's size.</span>";
        $("div.error-notification").html(error);
      }
      else if($("#hidden_color").val() == "")
      {
        var error = "<span>Please select the product's color.</span>";
        $("div.error-notification").html(error);
      }
      else
      {
        $("div.error-notification").html("");
        var qty = $("select#qty option:selected").val();
        $("#hidden_qty").val(qty);
        add_to_cart();
      }
    })

    $(document).on("click", "button.home-add-to-cart", function(){
        $productid = $(this).data('productid');
        $color = $(this).data('color');
        $size = $(this).data('size');
        $("#hidden_size").val($size);
        $("#hidden_color").val($color);
        $("#product_id").val($productid);
        add_to_cart();
    });

    function add_to_cart()
    {
      $.ajax({
        type: "POST",
        url: "/add_to_cart",
        data: $("#add_to_cart_form").serialize(),
        success :function (response)
        {
          alert("Cart "+response['msg']);
          var cart_html = `
          <div class="aa-cartbox-summary">
          <ul>`;
          var cart_total = 0;
          var cart_count = response.nav_cart_detail.length;
          $("span.aa-cart-notify").html(cart_count);
          $(response.nav_cart_detail).each(function( arrIndex, arrVal ) {
            cart_total = cart_total + (arrVal.qty * arrVal.price); 
            cart_html += 
            `<li>
                <a class="aa-cartbox-img" href="#"><img src="http://127.0.0.1:8000/storage/media/product/product_attr_image/`+arrVal.attr_image+`" alt="img"></a>
                <div class="aa-cartbox-info">
                  <h4><a href="#">`+arrVal.product_name+`</a></h4>
                  <p>`+arrVal.qty+` x Rs. `+arrVal.price+`</p>
                </div>
                <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
              </li>                   
              `
          });
          cart_html += `
              <li>
                <span class="aa-cartbox-total-title">
                  Total
                </span>
                <span class="aa-cartbox-total-price">
                  Rs. `+cart_total+`
                </span>
              </li>
            </ul>
            <a class="aa-cartbox-checkout aa-primary-btn" href="http://127.0.0.1:8000/checkout">Checkout</a>
            </div>`;
            $("div#cart_detail").html(cart_html);
            if(cart_count == 0)
            {
              $("div#cart_detail").html("");
            }
        }
      });
    }

    $('table input[type="number"]').attr({
        "min" : 0
    });
    $(document).on('change','input.cartpagequantity',function(){
      var product_id = $(this).closest("tr").data('product-id');
      var product_attr = $(this).closest("tr").data('product-attr');
      var price = $(this).closest("tr").data('price');
      var product_qty = $(this).val();
      $("#hidden_qty").val(product_qty);
      $("#hidden_product_id").val(product_id);
      $("#hidden_product_attr_id").val(product_attr);
      $("#hidden_price").val(price);
      // console.log($("td.updated_price_"+product_id+"_"+product_attr))
      update_cart_item("update",$("td.updated_price_"+product_id+"_"+product_attr));
    })

    function update_cart_item(type, element)
    {
      $.ajax({
        type: "POST",
        url: "/update_cart_qty",
        dataType: 'json', 
        encode  : true,
        data: $("#update_cart_form").serialize(),
        success: function (response)
        {
          if(type == "update")
          {
            element.html("Rs. "+response['price']);
            // console.log(element);
          }
          if(type == "delete")
          {
            element.fadeOut();
          }
          var cart_html = `
          <div class="aa-cartbox-summary">
          <ul>`;
          var cart_total = 0;
          var cart_count = response.nav_cart_detail.length;
          
          $("span.aa-cart-notify").html(cart_count);
          $(response.nav_cart_detail).each(function( arrIndex, arrVal ) {
            cart_total = cart_total + (arrVal.qty * arrVal.price); 
            cart_html += 
            `<li>
                <a class="aa-cartbox-img" href="#"><img src="http://127.0.0.1:8000/storage/media/product/product_attr_image/`+arrVal.attr_image+`" alt="img"></a>
                <div class="aa-cartbox-info">
                  <h4><a href="#">`+arrVal.product_name+`</a></h4>
                  <p>`+arrVal.qty+` x Rs. `+arrVal.price+`</p>
                </div>
                <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
              </li>                   
              `
          });
          cart_html += `
              <li>
                <span class="aa-cartbox-total-title">
                  Total
                </span>
                <span class="aa-cartbox-total-price">
                  Rs. `+cart_total+`
                </span>
              </li>
            </ul>
            <a class="aa-cartbox-checkout aa-primary-btn" href="#">Checkout</a>
            </div>`;
            $("div#cart_detail").html(cart_html);
            $("tr#subtotal td").html(`Rs. `+cart_total+``);
            $("tr#total td").html(`Rs. `+cart_total+``);
            if(cart_count == 0)
            {
              $("div#cart_detail").html("");
            }
          
        }
      });
    }

    $(document).on('click','td a.remove', function(){
      var cart_id = $(this).data('cart');
      $("#hidden_qty").val(0);
      $("#hidden_cart_id").val(cart_id);
      update_cart_item("delete",$(this).closest("tr"));
    }) 

    $("#sort_by").on("change", function(){
      var sort_type = $(this).val();
      $("form#product_filter #sort_type").val(sort_type);
      $("form#product_filter").submit();
    })
    
    // var start = jQuery("span#skip-value-lower").text();
    // var end = jQuery("span#skip-value-upper").text();
    // $("#price_filter_button").on("click", function(){
    //     alert(start+"---"+end);
    //     // $("form#product_filter #price_range_start").val(skip_value_lower);
    //     // $("form#product_filter #price_range_end").val(skip_value_upper);
    //     // $("form#product_filter").submit();
    // })

    $(document).on("click", "#color_code", function(){
      var color_id = $(this).data("color-id");
      var color_id_value = $("form#product_filter #color_filter").val();
      $("form#product_filter #color_filter").val(color_id_value+","+color_id);
      $("form#product_filter").submit();
    })

    $("#search_box_button").on("click", function(){
      var search_box_string = $("#search_box_string").val();
      if(search_box_string != "")
      {
        window.location.href = "/search/"+search_box_string;
      }
      // console.log(search_box_string);
    });

    $("form#registration_form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "/registration_process",
          data: $(this).serialize(),
          success: function(result){
            $("span.field_error").text(""); 
            var json_string = JSON.stringify(result);
            // console.log(json_string);
            var json_obj = $.parseJSON(json_string);
            console.log(json_obj);
            if(json_obj['status'] == 'error')
            {
                $.each(json_obj['error'], function(key, val){
                      $("span#"+key).text(val);
                });
            }
            if(json_obj['status'] == 'success')
            {
              $("span#thankyoumsg").text(json_obj['msg']);
              $("form#registration_form")[0].reset();
            }
          }
        });
    });

    $("form#login_form").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/login_process",
        data: $(this).serialize(),
        success: function(result){
          $("span.field_error").text(""); 
          var json_string = JSON.stringify(result);
          // console.log(json_string);
          var json_obj = $.parseJSON(json_string);
          // console.log(json_obj);
          if(json_obj['status'] == 'error')
          {
            $("span#login_err").text(json_obj['error']);   
          }
          if(json_obj['status'] == 'success')
          {
            window.location.href = window.location.href;
          }
        }
      });
    });

    $("div.lost_your_password").hide();
    $("a#lost_password_div_btn").on("click", function(){
      $("div.login").hide();
      $("div.lost_your_password").show();
    });
    $("a#login_div_btn").on("click", function(){
      $("div.login").show();
      $("div.lost_your_password").hide();
    });

    $("form#lost_your_password_form").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/reset_password_process",
        data: $(this).serialize(),
        success: function(result){
          $("span.field_error").text(""); 
          var json_string = JSON.stringify(result);
          // console.log(json_string);
          var json_obj = $.parseJSON(json_string);
          // console.log(json_obj);
          $("span#reset_pass_err").text("");
          if(json_obj['status'] == 'error')
          {
            $("span#reset_pass_err").text(json_obj['error']);   
          }
          if(json_obj['status'] == 'success')
          {
            $("span#reset_pass_err").text(json_obj['msg']);   
          }
        }
      });
    });

    $("form#reset_password_form").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/forgot_password_process",
        data: $(this).serialize(),
        success: function(result){
          $("span.field_error").text(""); 
          var json_string = JSON.stringify(result);
          // console.log(json_string);
          var json_obj = $.parseJSON(json_string);
          console.log(json_obj);
          if(json_obj['status'] == 'error')
          {
              $.each(json_obj['error'], function(key, val){
                    $("span#"+key).text(val);
              });
          }
          if(json_obj['status'] == 'cofirmation_error')
          {
            $("span#confirm_password").text("Password Should be same in both fields");
          }
          if(json_obj['status'] == 'success')
          {
            $("span#thankyoumsg").text("Password Should be same in both fields");
          }
          if(json_obj['status'] == 'success')
          {
            $("span#thankyoumsg").text(json_obj['msg']);
            $("form#reset_password_form")[0].reset();
            $("form#reset_password_form button").prop("disabled", true);
          }
        }
      });
  });

  $("#apply_coupon").on("click", function(){
      $(".coupon_error").html("");
      var coupon_code = $("#coupon_code").val();
      var token = $('input[name="_token"]').val();
      if(coupon_code != "")
      {
        $.ajax({
          type: "POST",
          url: "/apply_coupon_code",
          data: {
            coupon_code: coupon_code,
            _token: token
          },
          success: function(result){
            var json_obj = $.parseJSON(result);
            // console.log(json_obj);
            var coupon_html = `
            <th>Coupon Code Applied <a href="javascript:void(0)" id="remove_coupon"><span class="fa fa-times" style="color: #ed1313;float: right;margin-top: 4px;"></span></a></th>
            <td>`+coupon_code+`</td>`;
            $(".coupon_error").html(json_obj['msg']);
            if(json_obj['status'] == "success")
            {
              $("div#coupon_fields").hide();
              $("tr#coupon_applied").html(coupon_html);
              $("td#discounted_total").html(`Rs. `+json_obj['total_price']+``);
            }
            else if(json_obj['status'] == "error")
            {
              $(".coupon_error").html("Please Enter A Valid Coupon.");
            }
          }
        })
      }
      else
      {
        $(".coupon_error").html("Please Enter Coupon Code");
      }
  });
  $(document).on("click", "a#remove_coupon", function(){
    $(this).closest("tr#coupon_applied").html("");
    $(".coupon_error").html("");
    $("div#coupon_fields").show();
    var previous_total_price = $("td#discounted_total").data('total');
    $("td#discounted_total").html(previous_total_price);
  });

  $("form#placeorder_form").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/place_order",
      data: $(this).serialize(),
      success: function(result){
        $("span.field_error").text(""); 
        var json_string = JSON.stringify(result);
        // console.log(json_string);
        var json_obj = $.parseJSON(json_string);
        if(json_obj['status'] == 'success')
        {
          // console.log(json_obj['url']);
          // return;
          if(json_obj['checkout_url'] !== "")
          {
            window.location.href = json_obj['checkout_url'];
          }
          else
          {
            $("div#place_order_msg").text(json_obj['msg']);
            $("#placeorder_btn").prop("disabled", true);
            window.location.href = "/order_placed";
          }
        }
        else if(json_obj['status'] == 'false')
        {
          $("div#place_order_msg").text(json_obj['msg']);
        }
        else if(json_obj['status'] == 'required_error')
        {
          $("span#checkout_email").html("");
          $("span#checkout_email").html(json_obj['error']['email'][0]);
        }
      }
    });
  });
});

