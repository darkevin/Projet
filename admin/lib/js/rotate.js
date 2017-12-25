(function ($) {
    var Rotate = function (element, options)
    {
        var view360 = $(element);
        var obj = this;
        var defaults = {
            imageDir: 'images',
            imageExt: 'jpg', //could be png,jpg,bmp
            imageCount: 0,
            zoomPower: 2,
            zoomRadius: 100,
            autoRotate: false,
            autoRotateInterval: 5000/72, //3secondes -> 
            fadeInInterval: 400,
            canvasWidth: 0,
            canvasHeight: 0,
            canvasID: ''
        };

        var canvas;
        var loaded = false;
        var context;
        var iMouseX, iMouseY = 1;
        var bMouseDown = false;
        var tx;
        var img_Array = new Array();
        var ga = 1.0;
        var fadeTimerId = 0;
        var auto_rotate_count = 0;
        var autoRotateTimeId = 0;
        var modulus = 0;
        var zoomOn = 0;
        var autorotate_button;

        options = $.extend(defaults, options);

        var clear = function () {
            context.clearRect(0, 0, context.canvas.width, context.canvas.height);
        }

        var load_images = function () {

            context.font = '40px Calibri';
            context.fillText('Chargement ...', 100, 200);

            for (var i = 1; i <= options.imageCount; i++) {
                img_Array[i] = new Image();
                img_Array[i].src = options.imageDir + "/" + i + "." + options.imageExt;
            }

        }

        var fadeIn = function () {
            clear();
            context.globalAlpha = ga;
            image = new Image();

            image.onload = function ()
            {
                context.drawImage(image, 0, 0, context.canvas.width, context.canvas.height);
            };
            image.src = options.imageDir + "/" + "1." + options.imageExt;


            ga = ga + 0.1;
            if (ga > 1.0)
            {

                clearInterval(fadeTimerId);
            }

        }

        var init_ = function () {
            if (options.canvasWidth == 0) {
                alert("Provide a CANVAS WIDTH");
            }
            if (options.canvasHeight == 0) {
                alert("Provide a CANVAS Height");
            }
            if (options.imageCount <= 0) {
                alert("provide IMAGE COUNT ");
            }
            if (options.canvasID == "") {
                alert("provide CANVAS ID ");
            }
            if (options.zoomPower <= 0) {
                alert("Zoom Power have a value of greater than 0");
            }
            if (options.zoomRadius < 50) {
                alert("Provide a Zoom Radius of at least 50 or more ");
            }
            if (options.imageExt == "") {
                alert("Provide Image extension. Ex: png,jpg");
            }
            if (options.imageDir == "") {
                alert("Provide Image Direcotry");
            }


            view360.append("<canvas id='" + options.canvasID + "' width='" + options.canvasWidth + "' height='" + options.canvasHeight + "'></canvas>");//.css({cursor: 'pointer', margin: 'auto'});
//view360.append("<canvas id='"+options.canvasID+"'></canvas>");
//view360.css({width:options.canvasWidth + "px",height:options.canvasHeight + "px",position:'relative'});
            canvas = document.getElementById(options.canvasID);
            context = canvas.getContext('2d');
            //tx = canvas.width / options.imageCount;
            tx = 200 / 72;
//view360.find('.autorotate').css({position:"absolute",right:"1%",bottom:'1%',display:'block',padding:'5px'});
            clear();
            load_images();

            fadeTimerId = setInterval(function () {
                fadeIn();
            }, options.fadeInInterval);
            if (options.autoRotate == true && typeof img_Array[options.imageCount] != 'undefined') {
                start_auto_rotate();
                view360.find(".autorotate").text("Stop Auto Rotate");
            }

            view360.find("canvas").mousemove(function (e) {

                var canvasOffset = $(canvas).offset();
                iMouseX = Math.floor(e.pageX - canvasOffset.left);
                iMouseY = Math.floor(e.pageY - canvasOffset.top);
                modulus = Math.ceil(iMouseX / tx)%72+1;
//                if (modulus <= 0) {
//                    modulus = 1
//                } else if (modulus > options.imageCount) {
//                    modulus = 1
//                } else {
//                }
                ;

                if (options.autoRotate == false && bMouseDown == false) {

                    rotate360(modulus);
                }

                if (bMouseDown == true) {
                    zoom(img_Array[zoomOn]);
                }
            });

            view360.find("#" + options.canvasID).mousedown(function (e) {
                bMouseDown = true;
                if (options.autoRotate == true) {
                    stop_auto_rotate();
                }
                var canvasOffset = $(canvas).offset();
                iMouseX = Math.floor(e.pageX - canvasOffset.left);
                iMouseY = Math.floor(e.pageY - canvasOffset.top);
                zoomOn = Math.ceil(iMouseX / tx)%72+1; //find image number that is to be zoomed on
                if (zoomOn <= 0) {
                    zoomOn = 1
                } else if (zoomOn > options.imageCount) {
                    zoomOn = options.imageCount
                } else {
                }
                ;
            });


            view360.find("#" + options.canvasID).mouseup(function (e) {
                bMouseDown = false;
                zoomOn = 0;
//                $(this).css({cursor: 'pointer'});
            });

            view360.find(".autorotate").click(function (e) {
                e.preventDefault();
                if (options.autoRotate == false) {
                    start_auto_rotate();

                } else {
                    stop_auto_rotate();

                }
            });
            
            var res = (options.canvasID).replace("montre_", "");
            $("#"+res).on('mousewheel', "#r_oeil", function (e) {
                if  (options.autoRotate === true){
                    stop_auto_rotate();
                };

                if(e.originalEvent.wheelDelta < 0) {
                    modulus = (modulus%72)+1;
                    console.log(modulus);
                }else {
                    modulus = modulus-1;
                    if(modulus<1) modulus=72;
                    console.log(modulus);
                }
                rotate360(modulus);
                return false;
            });
            
        }

        var rotate360 = function (img_no) {
            clear();
            context.drawImage(img_Array[img_no], 0, 0, context.canvas.width, context.canvas.height);
        }

        var start_auto_rotate = function () {
            options.autoRotate = true;
            autoRotateTimeId = setInterval(function () {
                auto_rotate360();
            }, options.autoRotateInterval);
        }
        function stop_auto_rotate() {
            options.autoRotate = false;
            clearInterval(autoRotateTimeId);
        }
        
        function custom(){
            alert("ok");
        }

        function auto_rotate360() {
            if (modulus > 0 && modulus <= options.imageCount && auto_rotate_count <= 0) {
                auto_rotate_count = modulus;
            }
            auto_rotate_count++;
            if (auto_rotate_count > options.imageCount) {
                auto_rotate_count = 1;
            }
            rotate360(auto_rotate_count);
        }
        var zoom = function (image) {

            clear();
            if (bMouseDown) {
                context.drawImage(image, 0 - iMouseX * (options.zoomPower - 1), 0 - iMouseY * (options.zoomPower - 1), context.canvas.width * options.zoomPower, context.canvas.height * options.zoomPower);
                context.globalCompositeOperation = 'destination-atop';
                context.beginPath();
                context.arc(iMouseX, iMouseY, options.zoomRadius, 0, Math.PI * 2, true);
                context.closePath();
                context.fill();
            }

            context.drawImage(image, 0, 0, context.canvas.width, context.canvas.height);
        }

        init_();
    };
    $.fn.rotate = function (options)
    {
        return this.each(function ()
        {
            var element = $(this);
            if (element.data('rotate'))
                return;
            var rotate = new Rotate(this, options);
            element.data('rotate', rotate);
        });
    };
    
    $.fn.fdpxd = function(){
      stop_auto_rotate();  
    };
    
})(jQuery);	 