$(document).ready(function() {

              // Now that the DOM is fully loaded, create the dropzone, and setup the
              // event listeners
              var myDropzone = new Dropzone("#my-awesome-dropzone",{
                    maxFiles: 5,
                    maxFilesize: 1,
                    acceptedFiles: "image/*", /*is this correct?*/
                    init: function(){
                        this.on("success", function(file, data) {
                            /*..*/                            
                            });
                        this.on("maxfilesexceeded", function(file){
                            alert("No more files please!");
                            myDropzone.removeFile(file);
                        });
                        this.on("uploadprogress", function(file, progress) {
                            console.log("File progress", progress);
                        });    
                        }
                });              
              myDropzone.on("addedfile", function(file) {
                  file.previewElement.addEventListener("click", function() {
                    bootbox.confirm("¿Desea remover este archivo?", function(result) {
                        if(result==true){
                          myDropzone.removeFile(file);
                        }
                    });
                  });
                });
});