/** ! v2.1
 * @package Joomla
 * @author ELLE
 * @website http://joomext.ru/
 * @email support@joomext.ru
 * @copyright Copyright by ELLE. All rights reserved.
 * @license Proprietary. Copyrighted Commercial Software
 **/

 // reset default function
  function quicksetAttrValue(id,value)
 {

   Qattr_value[id]=value;
   quickreloadAttribSelectAndPrice(id);
   quickreloadAttribImg(id,value);
   }

 var prevAjaxHandler=null;var quickreloadAttribEvents=[];var extdataurlupdateattr={};
 function quickreloadAttribSelectAndPrice(id_select) {  
    var product_id = jQuery("#quick-view #product_id").val();
    var qty = jQuery("#quick-view #quantity").val();
    var data = {};
    data["change_attr"] = id_select;
    data["qty"] = qty;
    for (var i = 0; i < Qattr_list.length; i++) {
        var id = Qattr_list[i];
        data["attr[" + id + "]"] = Qattr_value[id];
    }
    for (extdatakey in extdataurlupdateattr) {
        data[extdatakey] = extdataurlupdateattr[extdatakey];
    }
    if (prevAjaxHandler) {
        prevAjaxHandler.abort();
    }
  
    prevAjaxHandler = jQuery.getJSON(Qurlupdateprice, data, function (json) {
        var reload_atribut = 0;
        for (var i = 0; i < Qattr_list.length; i++) {
            var id = Qattr_list[i];
            if (reload_atribut) {
                jQuery("#quick-view #block_attr_sel_" + id).html(json['id_' + id]);
            }
            if (id == id_select) reload_atribut = 1;
        }
        jQuery("#quick-view #block_price").html(json.price);
        if (json.basicprice) {
            jQuery("#quick-view #block_basic_price").html(json.basicprice);
        }
        for (key in json) {
            if (key.substr(0, 3) == "pq_") {
                jQuery("#quick-view #pricelist_from_" + key.substr(3)).html(json[key]);
            }
        }
        if (json.available == "0") {
            jQuery("#quick-view #not_available").html(translate_not_available);
        } else {
            jQuery("#quick-view #not_available").html("");
        }
        if (json.displaybuttons == "0") {
            jQuery(".productfull table.prod_buttons").hide();
        } else {
            jQuery(".productfull table.prod_buttons").show();
        }
        if (json.ean) {
            jQuery("#quick-view #product_code").html(json.ean);
        }
        if (json.weight) {
            jQuery("#quick-view #block_weight").html(json.weight);
        }
        if (json.pricedefault) {
            jQuery("#quick-view #pricedefault").html(json.pricedefault);
        }
        if (json.qty) {
            jQuery("#quick-view #product_qty").html(json.qty);
        }
        if (json.oldprice) {
            jQuery("#quick-view .old_price").html(json.oldprice);
        }
        if (json.images && json.images.length > 0) {
            var count_prod_img = json.images.length;
            var html_thumb_img = "";
            var html_middle_img = "";
            var html_zoom_img = '';
            if (typeof (jshop_product_hide_zoom_image) === 'undefined') jshop_product_hide_zoom_image = 0;

            for (var j = 0; j < count_prod_img; j++) {
             html_thumb_img += '<li><a href="' + liveproductimgpath + '/full_' + json.images[j] + '" rel="zoom-id:trainers" rev="' + liveproductimgpath + '/full_' + json.images[j] + '"><img class="jshop_img_thumb" src="' + liveproductimgpath + '/thumb_' + json.images[j] + '" onclick = "showImage(' + j + ')" /></a></li>';
               // tmp = 'style="display:none"';
                if(j == 0){
                tmp = '';
                html_middle_img = '<a class="MagicZoom" id="trainers" rel="zoom-width:430px; zoom-height:350px; selectors-change:mouseover; selectors-mouseover-delay:100" href="' + liveproductimgpath + '/full_' + json.images[j] + '" ' + tmp + '><img id="main_image_' + j + '" src="' + liveproductimgpath + '/full_' + json.images[j] + '" />' + html_zoom_img + '</a>';
              }

            }
            if (json.displayimgthumb == "1")
                jQuery("#quick-view #list_product_image_thumb").html('<ul id="jcarousel">' + html_thumb_img + '</ul>');
            else
                jQuery("#quick-view #list_product_image_thumb").html("");
            jQuery("#quick-view #list_product_image_middle").html(html_middle_img);

            MagicZoom.start();
            jQuery('#jcarousel').jcarousel({ scroll: 1, itemFallbackDimension: 588 });
        }
		 if (json.block_image_thumb || json.block_image_middle){
                jQuery("#quick-view #list_product_image_thumb").html(json.block_image_thumb);            
                jQuery("#quick-view #list_product_image_middle").html(json.block_image_middle);
				MagicZoom.start();
                jQuery('#jcarousel').jcarousel({ scroll: 1, itemFallbackDimension: 588 });
                
            }
			
        if (typeof (json.demofiles) != 'undefined') {
            jQuery("#quick-view #list_product_demofiles").html(json.demofiles);
        }
        jQuery.each(quickreloadAttribEvents, function (key, handler) {
            handler.call(this, json);
        });
        quickreloadAttrValue();
    });
}     

function quickreloadAttribImg(id, value) {
    var path = "";
    var img = "";
    if (value == "0") {
        img = "";
    } else {
        if (Qattr_img[value]) {
            img = Qattr_img[value];
			
        } else {
            img = "";
        }
    }
    if (img == "") {
        path = liveimgpath;
        img = "blank.gif";
    } else {
        path = liveattrpath;
    }
    jQuery("#quick-view #prod_attr_img_" + id).attr('src', path + "/" + img);
}

function quickreloadAttrValue() {
    for (var id in Qattr_value) {
        if (jQuery("#quick-view .input_type_radio input[name=jshop_attr_id\\[" + id + "\\]]").attr("type") == "radio") {
            Qattr_value[id] = jQuery("#quick-view input[name=jshop_attr_id\\[" + id + "\\]]:checked").val();
          } else {
            Qattr_value[id] = jQuery("#quick-view #jshop_attr_id" + id).val();
        }
     
    }
}

function quickreloadPrices() {
    var qty = jQuery("#quantity").val();
    if (qty != "") {
        quickreloadAttribSelectAndPrice(0);
    }
}

jQuery(document).ready(function () {
  var AjaxPreloader = '<img class="AjaxPreloader" src="' + QvSite + 'media/plg_quick_view/images/ajax-loader.gif"/>';

    jQuery('body').append('<div id="quick_view_overlay" style="display:none"></div><div id="quick_view_popup"></div>');
    jQuery(".list_product .product, .list_related .product").livequery(function(){
    var Qvcount = jQuery('.ExtQv').size();
    jQuery(this).each(function () {

        var parent = jQuery(this);
        var product_id = jQuery('input.product_id', parent).val();
        var category_id = jQuery('input.category_id', parent).val();
        var href = QvSite + 'index.php?option=com_jshopping&controller=product&task=view&category_id=' + category_id + '&product_id=' + product_id;


        jQuery('.ExtQv', parent).click(function () {
            var indx = jQuery(this).index('.ExtQv');
            var indxNext = indx+1;
            var indxPrev = indx-1;

         jQuery('.productfull .input_type_radio input').unbind();
            jQuery('body').append(AjaxPreloader);
            jQuery.ajax({
                type: "POST",
                url: href + '&ajax=1&quick=1',
                dataType: 'html',
                success: function (data) {
                    jQuery('#quick_view_popup').html(data);
                    jQuery('.AjaxPreloader').remove();
                    jQuery('#quick_view_overlay').show();
                    var scrol = jQuery(document).scrollTop();
                    var wind = jQuery(window).height() / 2;
                    var box = jQuery('#quick-view').height() / 2;
                    jQuery('#quick-view').css({
                        position: 'absolute',
                        //   left: (jQuery(window).width() - jQuery('#quick-view').outerWidth())/2,
                        top: (scrol + wind - box)
                    });
                    jQuery('#quick-view').show(300);

                    if(indx == 0) {
                            jQuery('#QvPrev').hide();
                   } else {
		                   jQuery('#QvPrev').click(function(){
                             jQuery('.ExtQv').eq(indxPrev).click();
                           });
	               }

                   if((Qvcount - indx) == 1) {
                              jQuery('#QvNext').hide();
                  }	else {
		                     jQuery('#QvNext').click(function(){
                                jQuery('.ExtQv').eq(indxNext).click();
                             });
                 	}


                    jQuery('.input_type_radio input').livequery(function(){
                    jQuery(this).click(function(){
                     var id = jQuery(this).attr('name').match(/\d+/g);
                     var value = this.value;                      
                      quicksetAttrValue(id,value);
                      });    
                    return true; 
                  });

       //quick - order
         jQuery(function() {
           jQuery(':radio,:input,select').live("click keyup", function(){
              jQuery(".qv-attrbuf").empty();
                      jQuery("#quick-view .attributes>div").each(function(){
                      jQuery('.qv-attrbuf').append(jQuery(this).find(".attributes_name").text());
                      jQuery('.qv-attrbuf').append(jQuery(this).find("input:radio:checked").siblings('label').text() + " ");
                      jQuery('.qv-attrbuf').append(jQuery(this).find(":selected").text() + " ");
                      jQuery('.qv-attrbuf').append(",<br />");
                       });
                       jQuery("#quick-view .free_attribs_item").each(function(){
                      jQuery('.qv-attrbuf').append(jQuery(this).find(".name").text());
                      jQuery('.qv-attrbuf').append(jQuery(this).find(".field :input").attr('value'));
                      jQuery('.qv-attrbuf').append(",<br />");
                       });
             jQuery('.qv-attrbuf').append(jQuery('#quick-view .prod_qty').text()+ " ");
             jQuery('.qv-attrbuf').append(jQuery('#quick-view .prod_qty_input :input').attr('value'));
           });
         });
 
                    // new cart

                    jQuery('.jshop_prod_attributes, input#quantity').click(function(){
                     jQuery('.msg_incart').hide();
                     jQuery('.cart_link, .wishlist_link').hide();
                     jQuery('#quick-view .buttons-quick input.quick_button_cart, #quick-view input.quick_button_wishlist').show();
                    });

                    jQuery("#quick-view .buttons-quick input.quick_button_cart").live("click", function () {
                        if (jQuery('#quick-view #to').val() == "addcart") {
                            jQuery("#quick-view .buttons-quick").append(AjaxPreloader);
                            jQuery("#system-message-container, #system-message").remove();
                            var allValue = jQuery('#quick-view form[name="product"]').serialize();
                            var tocart =  QvSite + 'index.php?option=com_jshopping&controller=cart&task=add&' + allValue;
                            var oMsg = new Object();

                            jQuery.ajax({
                                type: "POST",
                                cache: false,
                                url: tocart + '&ajax=1',
                                dataType: 'json',
                                ifModified: true,
                                success: function (oMsg) {
                                    jQuery('.AjaxPreloader').remove();
                                    if (oMsg.type_cart == "cart") {
                                        jQuery('.msg_incart').show();
                                        jQuery('#quick-view .buttons-quick input.quick_button_cart').hide();
                                        jQuery('.cart_link').show();

                                      //remove count product in Ice Cart
                                       var dcart = jQuery('#ice_cart .icecartlink').text().match(/\d+/g);
                                       if(dcart>0){
                                       iccart = jQuery('#ice_cart a.icecartlink').text();
                                       iccart2 = iccart.replace(/[0-9]+/, oMsg.count_product);
                                       jQuery('#ice_cart a.icecartlink').text(iccart2);
                                       }
                                       else{
                                        var cartLink = jQuery('.cart_link').attr('href');
                                        jQuery('#ice_cart .lof_jshop_top').empty().append(jQuery("<a href='" + cartLink + "' class='icecartlink'>1 позиций</a>"));
                                       }
                                    }
                                    else {
                                        alert(oMsg[0].message);
                                    }
                                }
                            });

                            return false;
                        }
                    });
                    // END NEW CART

                    // new wishlist
                    jQuery("#quick-view .buttons-quick input.quick_button_wishlist").live("click", function () {
                        if (jQuery('#quick-view #to').val() == "wishlist") {
                            jQuery("#quick-view .buttons-quick").append(AjaxPreloader);
                            jQuery("#system-message-container, #system-message").remove();
                            var allValue = jQuery('#quick-view form[name="product"]').serialize();
                            var towishlist = QvSite + 'index.php?option=com_jshopping&controller=cart&task=add&' + allValue;
                            var oMsg = new Object();
                            jQuery.ajax({
                                type: "POST",
                                cache: false,
                                url: towishlist + '&ajax=1',
                                dataType: 'json',
                                ifModified: true,
                                success: function (oMsg) {
                                    jQuery('.AjaxPreloader').remove();
                                    if (oMsg.type_cart == "wishlist") {
                                        jQuery('#quick-view input.quick_button_wishlist').hide();
                                        jQuery('.wishlist_link').show();
                                    }
                                    else {
                                        alert(oMsg[0].message);
                                    }
                                }
                            });

                            return false;
                        }
                    });
                    // END new wishlist

                    jQuery('#quick_view_overlay, #quick_view_close').click(function () {
                        jQuery('#quick-view').remove();
                        jQuery('#quick_view_overlay').hide(); 
                        jQuery('.input_type_radio input').unbind();
                    });
                  return false;
                }
            });
        });

    });
});

       // style attr radio and event
      jQuery('#quick-view .input_type_radio input').livequery(function(){
      str = jQuery(this).attr('onclick');
      str2 = str.replace('setAttrValue', 'quicksetAttrValue');
      jQuery(this).attr('onclick', str2);
      });

      // style attr select and event
      jQuery('#quick-view .jshop_prod_attributes select.inputbox').livequery(function(){
      str = jQuery(this).attr('onchange');
      str2 = str.replace('setAttrValue', 'quicksetAttrValue');
      jQuery(this).attr('onchange', str2);
      });

      jQuery('#quick-view .input_type_radio:first').addClass('checha');
      jQuery('#quick-view .input_type_radio').livequery(function(){
      jQuery(this).click(function(){
        jQuery(this).addClass('checha').children('input').attr('checked', 'checked');
        jQuery(this).siblings().removeClass('checha').children('input').removeAttr('checked', '');
        if (jQuery.browser.msie && jQuery.browser.version < 9) {
           // IE 8 or older
            jQuery(this).children('input').click();
            }
        });
      });

    jQuery(window).keydown(function (event) {
        if (event.keyCode == '27') {
            jQuery('#quick-view').remove();
            jQuery('#quick_view_overlay').hide();
        }
    });
});

   // style attr radio in productfull
  jQuery(document).ready(function(){
      jQuery('.input_type_radio:first').addClass('checha');
      jQuery('.input_type_radio').click(function(){
         jQuery(this).addClass('checha').children('input').attr('checked', 'checked');
         jQuery(this).siblings().removeClass('checha').children('input').removeAttr('checked', '');
           if (jQuery.browser.msie && jQuery.browser.version < 9) {
           // IE 8 or older
            jQuery(this).children('input').click();
            }
         });
  });