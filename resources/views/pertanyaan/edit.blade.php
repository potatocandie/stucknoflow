@extends('main')

@section('title', "Edit Pertanyaan")

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f48024;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f7aa6d;
        border: 1px solid #f48024;
        color: #fff;
    }
</style>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-powder text-powder">
        <span class="h5"><strong>Edit Pertanyaan</strong></span>
        <div class="lead text-md mt-2">
            <strong>
                <a href="{{ route('pertanyaan.index')}}" class="text-powder">Pertanyaan</a>
                <span class="text-gray">| Edit Pertanyaan</span>
            </strong>
        </div>
    </div>
    <div class="card-body login-card-body">
        <form action="{{ route('pertanyaan.update', $pertanyaan->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="judul">Judul Pertanyaan :</label>
                <input name="judul" type="text" class="form-control" value="{{ $pertanyaan->judul }}">
            </div>
            <div class="mb-3">
                <label for="tag">Tag: </label>
                <select name="tag[]" class="form-control js-example-basic-multiple" multiple="multiple">
                    @foreach ($tag as $item)
                    <option value="{{ $item->id }}">{{ $item->isi_tag }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="isi">Detail Pertanyaan:</label>
                <textarea name="isi" type="text" class="form-control my-editor"
                    rows="5">{{ $pertanyaan->isi }}</textarea>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary btn-block">Update Pertanyaan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('/js/select2.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $('.js-example-basic-multiple').select2()
    .val({!! json_encode($pertanyaan->tag()->pluck('tag.id')->toArray()) !!})
    .trigger('change')
    
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      menubar: false,
      toolbar: "insertfile undo redo | styleselect | bold italic | bullist numlist outdent indent | link image media",
      style_formats: [
                { title: 'Blocks', items: [
                { title: 'Paragraph', format: 'p' },
                { title: 'Blockquote', format: 'blockquote' },
                { title: 'Div', format: 'div' },
                { title: 'Pre', format: 'pre' }
            ]},
                { title: 'Inline', items: [
                { title: 'Bold', format: 'bold' },
                { title: 'Italic', format: 'italic' },
                { title: 'Underline', format: 'underline' },
                { title: 'Strikethrough', format: 'strikethrough' },
                { title: 'Superscript', format: 'superscript' },
                { title: 'Subscript', format: 'subscript' },
                { title: 'Code', format: 'code' }
            ]}],
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }
  
        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };
  
    tinymce.init(editor_config);
</script>
@endpush