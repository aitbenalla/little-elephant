<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Little Elephant 2022.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
{block name="javascripts"}{/block}
<script src="/assets/js/current-link.js"></script>
<script>
    
    setTimeout(function() {
        var paras = document.getElementsByClassName('alert');

        while(paras[0]) {
            paras[0].parentNode.removeChild(paras[0]);
        }
    }, 5000);
    
</script>
</body>

</html>