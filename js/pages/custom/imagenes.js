$(document).ready(function() {
var myDropzone = new Dropzone('#imagenes',{
            url: baseURL()+"img/",
            addRemoveLinks: true,
            maxFiles: 4,
            acceptedFiles: ".png, .jpg", //is this correct? I got an error if im using this
            init: function(){
                this.on("success", function(file, data) {
                    //......
                    alert("formato correcto");
                });
                this.on("removedfile", function(file) {
                   alert("formato incorrecto");
                });
            },
        });
        function baseURL(){
                return window.location.origin+'/Publiec/';
        }
});