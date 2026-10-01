
<script>

(function(){
  const root = document.getElementById('bmjm-sidebar-root');
  if(!root) return;
  fetch('../Includes/sidebar.php')
    .then(function(res){
      if(!res.ok) throw new Error('HTTP ' + res.status + ' fetching sidebar.php');
      return res.text();
    })
    .then(function(html){
      root.outerHTML = html;
    })
    .catch(function(err){
      console.error('bmjm sidebar failed to load:', err);
    });
})();

</script>