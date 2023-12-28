$(document).ready(function(){
  
    $(document).on("click", "#delete-cat, #delete-coupon, #delete-size, #delete-color, #delete-product, #delete-brand, #delete-tax, #delete-banner", function(){
        var url = $(this).data('url');
        var element = $(this).closest("tr");
        if(confirm("Are You Want To Delete This?"))
        {
            $.ajax({
                type:"GET", 
                url: url,
                dataType: 'json', 
                encode  : true,
                success: $(element).fadeOut(),
            });
        }
    });

    var attrbox_loop_count = $("div#attr_card_wrapper div.attr_box:last-child").data('attr-box');
    $("div.attr-card button#add_more_attr").on("click", function(){
        var attr_element = $("div.attr-card div#attr_box_1").html();
        attrbox_loop_count++;
        var new_attr_element = `
            <div class="m-t-30 attr_box" data-attr-box="`+attrbox_loop_count+`" id="attr_box_`+attrbox_loop_count+`">`+attr_element+`
                 <button style="float: right;" type="button" class="btn btn-danger btn-sm" data-box="`+attrbox_loop_count+`" id="remove_attr">Remove</button>
            </div>`;
        $("div.attr-card div#attr_card_wrapper").append(new_attr_element);


        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #sku").val("");
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #mrp").val("");
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #price").val("");
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #qty").val("");
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #colors option:selected").each(function () {
            $(this).removeAttr('selected'); 
        });
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" #size option:selected").each(function () {
            $(this).removeAttr('selected'); 
        });
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" input[type=hidden]").val("");
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" a#delete_attr").remove();
        $("div#attr_card_wrapper div#attr_box_"+attrbox_loop_count+" img").remove();
    });

    $(document).on("click","div.attr-card button#remove_attr", function(){
        var attr_box_id = $(this).data('box');
        $("div.attr-card div#attr_box_"+attr_box_id+"").remove();
    });

    var gallery_box_count = $("div#gallery_card_wrapper div.gallery_box:last-child").data('gallery-box');
    //console.log(gallery_box_count);
    $("div.gallery-card button#add_more_gallery").on("click", function(){
        gallery_box_count++;
        var gallery_box = `
        <div class="col-lg-6 m-t-30 gallery_box" data-gallery-box="`+gallery_box_count+`" id="gallery_box_`+gallery_box_count+`">
            <div class="form-group">
                <input name="gallery_image[]" type="file" class="form-control">
            </div>
            <input type="hidden" value="" name="product_image_id[]">
            <button type="button" style="float: right;" class="btn btn-danger btn-sm" data-box="`+gallery_box_count+`" id="remove_gallery">Remove</button>
        </div>`;
        $("div#gallery_card_wrapper").append( gallery_box);
    });
    $(document).on("click", "div#gallery_card_wrapper div.gallery_box button#remove_gallery", function(){
        var gallery_box_id = $(this).data('box');
        $("div#gallery_card_wrapper div#gallery_box_"+gallery_box_id+"").remove();
    });
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'technical_specification' );
    CKEDITOR.replace( 'uses' );
    CKEDITOR.replace( 'warrenty' );
});

