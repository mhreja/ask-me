@if(Session('success'))
<script>
    Command: toastr["success"]("{{Session('success')}}")
</script>
@endif

@if(Session('info'))
<script>
    Command: toastr["info"]("{{Session('info')}}")
</script>
@endif

@if(Session('warning'))
<script>
    Command: toastr["warning"]("{{Session('warning')}}")
</script>
@endif

@if(Session('error'))
<script>
    Command: toastr["error"]("{{Session('error')}}")
</script>
@endif


@if(Session('newquestionadded'))
<script>
    swal("Awesome!", "{{Session('newquestionadded')}}", "success");        //success, info, warning, error
</script>
@endif