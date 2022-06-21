
    $(document).ready(function() {
        $('.category-select2').select2();
    });

    $(document).ready(function() {
        $('.category-select2').select2({
          placeholder: "Select a category",
          allowClear: true,
          tags: true,
          tokenSeparators: [',', ' ']
        });
    });
        