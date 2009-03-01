<script>

    function showHideSwitch (theid, lnk) {
        if (document.getElementById) {
            var switch_id = document.getElementById(theid);

            if (switch_id.className == "logo showSwitch") {
                // collapse
                switch_id.className = 'logo hideSwitch';
                lnk.innerHTML = "expand header";


                var today = new Date();
                expires = 365 * 1000 * 60 * 60 * 24;
                var expires_date = new Date( today.getTime() + (expires) );
                document.cookie = theid+'=hideSwitch'+'; path=/' + ";expires=" + expires_date.toGMTString();
            } else { 
                // expand
                switch_id.className = 'logo showSwitch';
                lnk.innerHTML = "collapse header";

                var today = new Date();
                expires = 365 * 1000 * 60 * 60 * 24;
                var expires_date = new Date( today.getTime() + (expires) );
                document.cookie = theid+'=showSwitch'+'; path=/' + ";expires=" + expires_date.toGMTString();

            }
        }
    }

</script>
