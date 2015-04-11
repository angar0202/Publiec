<script>
            $(function() {
              // Now that the DOM is fully loaded, create the dropzone, and setup the
              // event listeners
              var myDropzone = new Dropzone("#my-awesome-dropzone");
              myDropzone.on("addedfile", function(file) {
                /* Maybe display some more file information on your page */
                alert("ok");
              });
            });
        </script>