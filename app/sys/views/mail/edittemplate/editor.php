<!-- CKEditor Container -->
<textarea id="js-ckeditor" name="ckeditor">Hello CKEditor!</textarea>
<script>
    $(function () {
        // Init page plugins & helpers
        // Disable auto init when contenteditable property is set to true
        //CKEDITOR.disableAutoInline = true;

        // Init inline text editor
        //CKEDITOR.inline('js-ckeditor-inline');

        // Init full text editor
        CKEDITOR.replace('js-ckeditor');
    });
    $(document).ready(function() {
        //
    } );
</script>