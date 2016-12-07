<!-- Table News-->
<div class="container col-md-12">

    <br>
    <br>
    <link rel="stylesheet" href="/css/dropzone.css">
    <script src="/js/dropzone.js"></script>
    <form action="gallery" method="post" enctype="multipart/form-data"
          class="dropzone"
          id="my-awesome-dropzone" name="file">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>

    <script>

        Dropzone.autoDiscover = false;


        var myDropzone = new Dropzone("#my-awesome-dropzone", {
            url: "gallery",
            acceptedFiles: ".pdf, .png, .jpg, .jpeg",
            addRemoveLinks: true,

            init: function () {

                this.on("removedfile", function (file) {
                    var name = file.name;
                    console.log(name);
                    $.ajax({
                        type: 'POST',
                        url: 'gallery/delete/',
                        data: "id=" + name,
                        success: function (data) {
                            if (data === 200) {
                                console.log('nice')
                            }
                        }

                    });
                });
            }
        });
        $.getJSON('gallery', function (data) {
            $.each(data, function (index, val) {
                var mockFile = {name: val.image, size: Math.random() * 100};
                myDropzone.options.addedfile.call(myDropzone, mockFile);
                myDropzone.options.thumbnail.call(myDropzone, mockFile, "/files/gallery/" + val.image);
                myDropzone.emit("complete", mockFile);
            });
        });
    </script>

    <style>
        img {
            width:100%;
            height:100%;

        }
    </style>
</div>
