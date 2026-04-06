@props([
    'name' => 'featured_image',
    'id' => null,
    'aspectRatio' => null,
    'label' => 'Gambar',
    'hint' => null,
    'maxSizeMb' => 5,
    'currentImage' => null,
    'currentAlt' => '',
    'optional' => true,
    'previewClass' => 'h-48',
    'error' => null,
])

@php
    $uid = $id ?? 'crop_' . Str::random(6);
    $fileId = 'file_' . $uid;
    $cropImgId = 'cropimg_' . $uid;
    $outputId = 'output_' . $uid;
    $dropId = 'drop_' . $uid;
    $previewId = 'preview_' . $uid;
    $modalId = 'modal_' . $uid;

    $ratioJs = 'NaN';
    if ($aspectRatio) {
        [$w, $h] = explode('/', $aspectRatio);
        $ratioJs = round((float) $w / (float) $h, 6);
    }

    $ratioLabel = match ($aspectRatio) {
        '16/9' => '16:9',
        '4/3' => '4:3',
        '1/1' => '1:1',
        default => null,
    };
@endphp

{{-- Label --}}
<div class="flex items-center gap-2 mb-1">
    <label class="text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($optional)
            <span class="ml-1 text-xs font-normal text-gray-400">(opsional)</span>
        @endif
    </label>
    @if ($ratioLabel)
        <span class="px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
            Rasio {{ $ratioLabel }}
        </span>
    @endif
</div>

@if ($hint)
    <p class="mb-2 text-xs text-gray-400">{{ $hint }}</p>
@endif

{{-- Gambar saat ini --}}
@if ($currentImage)
    <div class="p-3 mb-3 border border-gray-200 rounded-lg bg-gray-50" id="currentImg_{{ $uid }}">
        <p class="mb-2 text-xs font-medium text-gray-500">Gambar Saat Ini</p>
        <img src="{{ $currentImage }}" alt="{{ $currentAlt }}"
            class="object-cover transition-opacity rounded-lg max-h-36" id="currentImgEl_{{ $uid }}">
        <p class="mt-1 text-xs text-gray-400">Upload gambar baru untuk mengganti</p>
    </div>
@endif

{{-- Drop Zone --}}
<div id="{{ $dropId }}"
    class="relative p-6 text-center transition-all border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50/40">
    <input type="file" id="{{ $fileId }}" accept="image/*" class="hidden">
    <i class="mb-2 text-3xl text-gray-400 fas fa-crop-alt"></i>
    <p class="text-sm text-gray-600">
        Seret &amp; letakkan atau
        <span class="font-semibold text-blue-600">pilih gambar</span>
    </p>
    <p class="mt-1 text-xs text-gray-400">
        JPG, PNG, WebP · Maks {{ $maxSizeMb }}MB
        @if ($ratioLabel)
            · Crop {{ $ratioLabel }}
        @endif
    </p>
</div>

{{-- Preview setelah crop --}}
<div id="{{ $previewId }}" class="hidden mt-3">
    <div class="flex items-start gap-3 p-3 border border-green-200 rounded-lg bg-green-50">
        <img id="previewImg_{{ $uid }}" src="" alt="Preview"
            class="object-cover rounded-lg shrink-0 {{ $previewClass }} max-w-[200px]">
        <div class="flex-1 min-w-0 pt-1">
            <p class="text-xs font-semibold text-green-700">
                <i class="mr-1 fas fa-check-circle"></i>Gambar siap diupload
            </p>
            <p id="previewInfo_{{ $uid }}" class="mt-1 text-xs text-gray-500 break-all"></p>
            <button type="button" id="resetBtn_{{ $uid }}"
                class="mt-2 text-xs text-red-500 underline hover:text-red-700">
                <i class="mr-1 fas fa-redo"></i>Ganti gambar
            </button>
        </div>
    </div>
</div>

{{--
    PENTING: Menggunakan hidden TEXT input (bukan file input) untuk mengirim
    hasil crop sebagai base64 string. Ini lebih reliable di shared hosting
    karena DataTransfer API untuk set file input via JS tidak selalu berfungsi.
    Controller akan decode base64 ini dan simpan ke storage.
--}}
<input type="hidden" name="{{ $name }}_base64" id="{{ $outputId }}" aria-hidden="true">

@if ($error)
    <p class="mt-1 text-xs text-red-600">{{ $error }}</p>
@endif

{{-- Modal Crop --}}
<div id="{{ $modalId }}" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
    style="background:rgba(0,0,0,0.8)">
    <div class="flex flex-col w-full max-w-2xl overflow-hidden bg-white shadow-2xl rounded-2xl" style="max-height:92vh">

        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div>
                <h3 class="font-bold text-gray-900">Sesuaikan Gambar</h3>
                <p class="mt-0.5 text-xs text-gray-400">Geser &amp; zoom untuk mengatur area crop</p>
            </div>
            <button type="button" id="cancelBtn_{{ $uid }}"
                class="flex items-center justify-center w-8 h-8 text-gray-400 rounded-lg hover:bg-gray-100">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="relative flex-1 overflow-hidden bg-gray-900" style="min-height:300px;max-height:55vh">
            <img id="{{ $cropImgId }}" src="" alt="crop"
                style="display:block;max-width:100%;max-height:100%">
        </div>

        <div class="flex flex-wrap items-center gap-2 px-5 py-3 border-t border-gray-100 bg-gray-50">
            <span class="mr-1 text-xs font-semibold text-gray-400">Rotasi &amp; Flip:</span>
            <button type="button" id="rot_n90_{{ $uid }}"
                class="px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
                <i class="mr-1 fas fa-undo"></i>-90°
            </button>
            <button type="button" id="rot_p90_{{ $uid }}"
                class="px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
                <i class="mr-1 fas fa-redo"></i>+90°
            </button>
            <button type="button" id="flipX_{{ $uid }}"
                class="px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
                <i class="mr-1 fas fa-arrows-alt-h"></i>Flip H
            </button>
            <button type="button" id="flipY_{{ $uid }}"
                class="px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
                <i class="mr-1 fas fa-arrows-alt-v"></i>Flip V
            </button>
            <button type="button" id="resetCropper_{{ $uid }}"
                class="px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
                <i class="mr-1 fas fa-sync"></i>Reset
            </button>
        </div>

        <div class="flex gap-3 px-5 py-4 border-t border-gray-100">
            <button type="button" id="cancelBtn2_{{ $uid }}"
                class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">
                Batal
            </button>
            <button type="button" id="confirmBtn_{{ $uid }}"
                class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                <i class="mr-2 fas fa-check"></i>Gunakan Gambar Ini
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        var UID = '{{ $uid }}';
        var RATIO = {{ $ratioJs }};
        var MAX_MB = {{ $maxSizeMb }};

        var fileInput = document.getElementById('{{ $fileId }}');
        var outputInput = document.getElementById('{{ $outputId }}'); // hidden text input
        var dropZone = document.getElementById('{{ $dropId }}');
        var modal = document.getElementById('{{ $modalId }}');
        var cropImg = document.getElementById('{{ $cropImgId }}');
        var previewBox = document.getElementById('{{ $previewId }}');
        var previewImg = document.getElementById('previewImg_' + UID);
        var previewInfo = document.getElementById('previewInfo_' + UID);
        var resetBtn = document.getElementById('resetBtn_' + UID);
        var confirmBtn = document.getElementById('confirmBtn_' + UID);
        var cancelBtn = document.getElementById('cancelBtn_' + UID);
        var cancelBtn2 = document.getElementById('cancelBtn2_' + UID);

        var cropper = null;
        var scaleX = 1;
        var scaleY = 1;

        // ── Drop zone click
        dropZone.addEventListener('click', function() {
            fileInput.click();
        });

        // ── Drag over styling
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
            dropZone.classList.remove('border-gray-300');
        });
        dropZone.addEventListener('dragleave', function() {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            dropZone.classList.add('border-gray-300');
        });
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            dropZone.classList.add('border-gray-300');
            var f = e.dataTransfer.files && e.dataTransfer.files[0];
            if (f) loadFile(f);
        });

        // ── File input change
        fileInput.addEventListener('change', function() {
            var f = fileInput.files && fileInput.files[0];
            if (f) loadFile(f);
        });

        function loadFile(file) {
            if (!file.type.startsWith('image/')) {
                alert('Pilih file gambar yang valid (JPG, PNG, WebP)');
                return;
            }
            if (file.size > MAX_MB * 1024 * 1024) {
                alert('Ukuran file maksimal ' + MAX_MB + 'MB');
                return;
            }
            var reader = new FileReader();
            reader.onload = function(ev) {
                cropImg.src = ev.target.result;
                openModal();
            };
            reader.readAsDataURL(file);
        }

        function openModal() {
            modal.style.display = 'flex';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            scaleX = 1;
            scaleY = 1;
            setTimeout(function() {
                if (typeof window.Cropper === 'undefined') {
                    alert('Cropper tidak tersedia. Coba refresh halaman.');
                    modal.style.display = 'none';
                    return;
                }
                cropper = new window.Cropper(cropImg, {
                    aspectRatio: RATIO,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.85,
                    responsive: true,
                    checkCrossOrigin: false,
                });
            }, 50);
        }

        function closeModal() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            modal.style.display = 'none';
            fileInput.value = '';
        }

        cancelBtn.addEventListener('click', closeModal);
        cancelBtn2.addEventListener('click', closeModal);

        // ── ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
        });

        // ── Confirm crop — simpan sebagai base64 ke hidden text input
        confirmBtn.addEventListener('click', function() {
            if (!cropper) return;

            var canvas = cropper.getCroppedCanvas({
                maxWidth: 1920,
                maxHeight: 1920,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            // Konversi ke base64 dan simpan ke hidden input
            // Tidak pakai DataTransfer/File API yang tidak reliable di shared hosting
            var base64 = canvas.toDataURL('image/jpeg', 0.92);
            outputInput.value = base64;

            // Tampilkan preview
            previewImg.src = base64;
            // Estimasi ukuran: base64 ~75% dari size asli
            var sizeKb = Math.round((base64.length * 0.75) / 1024);
            previewInfo.textContent = 'crop_' + Date.now() + '.jpg · ~' + sizeKb + ' KB';
            previewBox.classList.remove('hidden');
            previewBox.classList.add('flex');

            // Dim gambar lama
            var ci = document.getElementById('currentImgEl_' + UID);
            if (ci) ci.style.opacity = '0.3';

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            modal.style.display = 'none';
        });

        // ── Reset
        resetBtn.addEventListener('click', function() {
            outputInput.value = '';
            fileInput.value = '';
            previewBox.classList.add('hidden');
            previewBox.classList.remove('flex');
            previewImg.src = '';
            previewInfo.textContent = '';
            var ci = document.getElementById('currentImgEl_' + UID);
            if (ci) ci.style.opacity = '1';
        });

        // ── Rotate & Flip
        document.getElementById('rot_n90_' + UID).addEventListener('click', function() {
            if (cropper) cropper.rotate(-90);
        });
        document.getElementById('rot_p90_' + UID).addEventListener('click', function() {
            if (cropper) cropper.rotate(90);
        });
        document.getElementById('flipX_' + UID).addEventListener('click', function() {
            scaleX *= -1;
            if (cropper) cropper.scaleX(scaleX);
        });
        document.getElementById('flipY_' + UID).addEventListener('click', function() {
            scaleY *= -1;
            if (cropper) cropper.scaleY(scaleY);
        });
        document.getElementById('resetCropper_' + UID).addEventListener('click', function() {
            scaleX = 1;
            scaleY = 1;
            if (cropper) cropper.reset();
        });

    })();
</script>
