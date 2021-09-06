@props([
'class' => '',
'name',
'preview' => '#__imagePreview__',
'width' => 144,
'height' => 144,
])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css"
    integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA=="
    crossorigin="anonymous" />

@if($preview === '#__imagePreview__')
<img class="w-20 h-20 border my-2" src="{{ asset('images/avatar.jpg') }}" alt="" id="__imagePreview__">
@endif


<input class="{{ $class }}" id="__image__" type="file" accept="image/*" onclick="this.value=''"
    onchange="cropImage(this)" />

<textarea class="hidden" name="{{ $name }}" id="image" cols="30" rows="10"></textarea>

<div id="imageCropBoxWrapper"
    class="w-full flex justify-center items-center z-50 left-0 top-0 right-0 bottom-0 bg-black opacity-95 overflow-auto">
    <div class="max-w-xs md:max-w-lg max-h-screen text-right m-auto">
        <img id="imageCropBox" class="w-auto h-auto">
        <div class="hidden" id="buttonWrapper">
            <div class="flex justify-between">
                <button type="button" class="px-4 py-1.5 mt-4 rounded-md bg-red-600 text-white"
                    id="cancle">Cancle</button>
                <button type="button" class="px-4 py-1.5 mt-4 rounded-md bg-blue-600 text-white" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"
    integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA=="
    crossorigin="anonymous"></script>
<script>
    var imageCropBox = document.getElementById('imageCropBox');
        var imageCropBoxWrapper = document.getElementById('imageCropBoxWrapper');
        var buttonWrapper = document.getElementById('buttonWrapper');
        var cropper, reader, file;

        function cropImage(e) {
            imageCropBoxWrapper.classList.add('absolute')
            var files = e.files;
            
            var done = function (url) {
                imageCropBox.src = url;
            };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            cropper = new Cropper(imageCropBox, {
                aspectRatio: {{ $width / $height }},
                viewMode: 3,
            });

            buttonWrapper.classList.remove('hidden')
        }

        document.getElementById('cancle').onclick = function () {
            cropper.destroy();
            cropper = null;

            buttonWrapper.classList.add('hidden')
            document.getElementById('__image__').value = ''
            imageCropBox.src = ''
            imageCropBoxWrapper.classList.remove('absolute')
        }

        document.getElementById('crop').onclick = function () {
            canvas = cropper.getCroppedCanvas({
                width: {{ $width }},
                height: {{ $height }},
            });

            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    imageCropBox.src = '';
                    document.getElementById('image').innerHTML = base64data;
                    document.querySelector('{{ $preview }}').src = base64data;
                };
            });

            cropper.destroy();
            cropper = null;

            buttonWrapper.classList.add('hidden')
            imageCropBoxWrapper.classList.remove('absolute')
        }

</script>