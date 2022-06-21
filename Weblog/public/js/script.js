
    $(document).ready(function() {
        $('.category-select2').select2();
    });

    $(document).ready(function() {
        $('.category-select2').select2({
          placeholder: "Select a state",
          allowClear: true,
          tags: true,
          tokenSeparators: [',', ' ']
        });
    });
        