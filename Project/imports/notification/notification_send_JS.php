<script>
  (function (window, $) {
  if (!$) return;

  window.bmjmNotify = {
    send: function (payload) {
      return $.ajax({
        url: <?php echo json_encode((isset($pth) && $pth !== '' ? $pth : '../../') . 'View-List/Notification/send_notification.php'); ?>,
        type: 'POST',
        data: payload
      });
    },

    sendToAll: function (title, body) {
      return this.send({ type: 'all', title: title, body: body });
    },

    sendToAllWithImage: function (title, body, imagePth) {
      return this.send({ type: 'all', title: title, body: body, image_pth: imagePth || '' });
    },

    sendToSubscription: function (subscriptionId, title, body) {
      return this.send({
        type: 'subscription',
        subscription_id: subscriptionId,
        title: title,
        body: body
      });
    },

    sendToSubscriptionWithImage: function (subscriptionId, title, body, imagePth) {
      return this.send({
        type: 'subscription',
        subscription_id: subscriptionId,
        title: title,
        body: body,
        image_pth: imagePth || ''
      });
    }
  };
})(window, window.jQuery);
</script>
