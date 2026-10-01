<script>
var adminNotificationPage = 1;
var adminNotificationTotalPages = 1;
var adminNotificationSearchTimer = null;

function adminNotificationEscape(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function adminNotificationToast(message, type) {
    var toast = document.getElementById('admin-notification-toast');
    if (!toast) return;
    toast.className = 'notify-toast ' + (type || 'success');
    toast.textContent = message;
    toast.style.display = 'block';
    setTimeout(function() { toast.style.display = 'none'; }, 5000);
}

function adminNotificationShowList() {
    var listView = document.getElementById('admin-notification-list-view');
    var addView = document.getElementById('admin-notification-add-view');
    if (listView) listView.classList.add('is-active');
    if (addView) addView.classList.remove('is-active');
    adminNotificationsLoad();
}

function adminNotificationShowAdd() {
    var listView = document.getElementById('admin-notification-list-view');
    var addView = document.getElementById('admin-notification-add-view');
    if (listView) listView.classList.remove('is-active');
    if (addView) addView.classList.add('is-active');
}

function adminNotificationReset() {
    var form = document.getElementById('admin-notification-form');
    var preview = document.getElementById('notification-image-preview');
    var previewImg = document.getElementById('notification-image-preview-img');
    var previewName = document.getElementById('notification-image-preview-name');
    var fileName = document.getElementById('notification-image-file-name');
    if (form) form.reset();
    if (preview) preview.style.display = 'none';
    if (previewImg) previewImg.src = '';
    if (previewName) previewName.textContent = '';
    if (fileName) fileName.textContent = 'No image selected';
}

function adminNotificationPreviewImage() {
    var fileEl = document.getElementById('notification-image-file');
    var preview = document.getElementById('notification-image-preview');
    var previewImg = document.getElementById('notification-image-preview-img');
    var previewName = document.getElementById('notification-image-preview-name');
    var fileName = document.getElementById('notification-image-file-name');
    var file = fileEl && fileEl.files && fileEl.files[0] ? fileEl.files[0] : null;

    if (!file) {
        if (preview) preview.style.display = 'none';
        if (previewName) previewName.textContent = '';
        if (fileName) fileName.textContent = 'No image selected';
        return;
    }

    if (previewImg) previewImg.src = URL.createObjectURL(file);
    if (previewName) previewName.textContent = file.name;
    if (fileName) fileName.textContent = file.name;
    if (preview) preview.style.display = 'flex';
}

function adminNotificationParseResponse(xhr) {
    if (!xhr || !xhr.responseText) return null;
    try {
        return JSON.parse(xhr.responseText);
    } catch (e) {
        return null;
    }
}

function adminNotificationShowSaveResult(res, fallbackMessage, fallbackType) {
    var message = (res && res.message) || fallbackMessage || 'Failed to send notification.';
    var type = fallbackType || 'error';
    if (res && res.status === 'success') type = 'success';
    if (res && res.status === 'warning') type = 'warning';
    adminNotificationToast(message, type);
    return type;
}

function adminNotificationSubmit(event, actionType) {
    if (event && event.preventDefault) event.preventDefault();

    var titleEl = document.getElementById('notification-title');
    var messageEl = document.getElementById('notification-message');
    var audienceEl = document.getElementById('notification-audience');
    var imageFileEl = document.getElementById('notification-image-file');
    var submitBtn = document.querySelector('#admin-notification-form button[type="submit"]');

    var title = titleEl ? titleEl.value.trim() : '';
    var message = messageEl ? messageEl.value.trim() : '';

    if (!title || !message) {
        adminNotificationToast('Please enter a title and message.', 'error');
        return false;
    }

    var formData = new FormData();
    formData.append('title', title);
    formData.append('message', message);
    formData.append('audience', audienceEl ? audienceEl.value : 'all_members');
    formData.append('action_type', actionType || 'send_now');
    if (audienceEl && audienceEl.value && audienceEl.value !== 'all_members') {
        formData.append('subscription_id', audienceEl.value);
    }

    if (imageFileEl && imageFileEl.files && imageFileEl.files[0]) {
        formData.append('notification_image', imageFileEl.files[0]);
    }

    if (submitBtn) submitBtn.disabled = true;
    if (typeof bmjmShowProcessing === 'function') {
        bmjmShowProcessing('Sending notification...', 'Please wait while the notification is prepared.');
    }

    $.ajax({
        url: "<?php echo $pth; ?>View-List/Notification/admin_notification_save.php",
        type: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        timeout: 25000,
        complete: function() {
            if (submitBtn) submitBtn.disabled = false;
            if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
        },
        success: function(res) {
            var type = adminNotificationShowSaveResult(res, 'Notification saved.', 'success');
            if (type === 'success' || type === 'warning') {
                adminNotificationReset();
                adminNotificationPage = 1;
                adminNotificationShowList();
            }
        },
        error: function(xhr) {
            var res = adminNotificationParseResponse(xhr);
            if (res && (res.status === 'success' || res.status === 'warning')) {
                adminNotificationShowSaveResult(res, 'Notification saved.', res.status);
                adminNotificationReset();
                adminNotificationPage = 1;
                adminNotificationShowList();
                return;
            }
            var fallback = xhr && xhr.statusText === 'timeout'
                ? 'The save request timed out. Check notifications and notification_inbox, then send again.'
                : 'Failed to send notification.';
            adminNotificationShowSaveResult(res, fallback, 'error');
            console.error('Notification save error:', xhr && xhr.responseText ? xhr.responseText : xhr);
        }
    });

    return false;
}

function adminNotificationGetPerPage() {
    var perPageEl = document.getElementById('admin-notification-per-page');
    return perPageEl ? perPageEl.value : 10;
}

function adminNotificationGetSearch() {
    var searchEl = document.getElementById('admin-notification-search');
    return searchEl ? searchEl.value.trim() : '';
}

function adminNotificationGetAudience() {
    var audienceEl = document.getElementById('admin-notification-audience');
    return audienceEl ? audienceEl.value : 'all_members';
}

function adminNotificationGetAudienceLabel() {
    var audienceEl = document.getElementById('admin-notification-audience');
    if (audienceEl && audienceEl.options && audienceEl.selectedIndex >= 0) {
        return audienceEl.options[audienceEl.selectedIndex].text;
    }
    return 'All members';
}

function adminNotificationGetSort() {
    var sortEl = document.getElementById('admin-notification-sort');
    return sortEl ? sortEl.value : 'newest';
}

function adminNotificationsSearchDelay() {
    if (adminNotificationSearchTimer) clearTimeout(adminNotificationSearchTimer);
    adminNotificationSearchTimer = setTimeout(function() {
        adminNotificationPage = 1;
        adminNotificationsLoad();
    }, 300);
}

function adminNotificationsFilterChange() {
    adminNotificationPage = 1;
    adminNotificationsLoad();
}

function adminNotificationsPerPageChange() {
    adminNotificationPage = 1;
    adminNotificationsLoad();
}

function adminNotificationsChangePage(direction) {
    var nextPage = adminNotificationPage + direction;
    if (nextPage < 1 || nextPage > adminNotificationTotalPages) return;
    adminNotificationPage = nextPage;
    adminNotificationsLoad();
}

function adminNotificationRenderPagination(pagination, rowCount) {
    pagination = pagination || {};
    adminNotificationPage = parseInt(pagination.page || 1, 10);
    adminNotificationTotalPages = parseInt(pagination.total_pages || 1, 10);

    var pageInfo = document.getElementById('admin-notification-page-info');
    var summary = document.getElementById('admin-notification-result-summary');
    var prevBtn = document.getElementById('admin-notification-prev');
    var nextBtn = document.getElementById('admin-notification-next');
    var total = parseInt(pagination.total || 0, 10);
    var perPage = parseInt(pagination.per_page || adminNotificationGetPerPage(), 10);
    var currentCount = parseInt(rowCount || 0, 10);
    var start = total === 0 ? 0 : ((adminNotificationPage - 1) * perPage) + 1;
    var end = total === 0 ? 0 : Math.min(start + currentCount - 1, total);
    var search = adminNotificationGetSearch();
    var audienceLabel = adminNotificationGetAudienceLabel();

    if (pageInfo) {
        pageInfo.textContent = total > 0 ? 'Showing ' + start + '-' + end + ' of ' + total : 'No notifications';
    }
    if (summary) {
        summary.textContent = search
            ? total + ' ' + audienceLabel.toLowerCase() + ' result' + (total === 1 ? '' : 's') + ' for "' + search + '"'
            : total + ' ' + audienceLabel.toLowerCase() + ' notification' + (total === 1 ? '' : 's') + ' created';
    }
    if (prevBtn) prevBtn.disabled = adminNotificationPage <= 1;
    if (nextBtn) nextBtn.disabled = adminNotificationPage >= adminNotificationTotalPages;
}

function adminNotificationImageThumb(imagePth) {
    if (!imagePth) return '';

    if (/^https?:\/\//i.test(imagePth)) {
        return '<img class="notify-image-thumb" src="' + adminNotificationEscape(imagePth) + '" alt="">';
    }

    if (imagePth.indexOf('Data/') === 0 || imagePth.indexOf('Uploads/') === 0) {
        return '<img class="notify-image-thumb" src="<?php echo $pth; ?>' + adminNotificationEscape(imagePth) + '" alt="">';
    }

    return '';
}

function adminNotificationAudienceLabel(row) {
    var audience = row && row.audience ? row.audience : '';
    var type = row && row.type ? row.type : '';
    var subscriptionId = row && row.subscription_id ? row.subscription_id : '';

    if (audience === 'all_members' || type === 'all') return 'All Members';
    if (audience === 'subscription' || subscriptionId === 'subscription' || subscriptionId === 'monthly') return 'Subscription';
    if (audience === 'zakath_payee' || subscriptionId === 'zakath_payee' || subscriptionId === 'zakath') return 'Zakath payers';
    if (audience === 'zakath_receiver' || subscriptionId === 'zakath_receiver') return 'Zakath receivers';
    if (type === 'auto') return 'Automatic';
    if (audience === 'subscription' || type === 'subscription') return 'Subscription';
    return audience || type || 'Members';
}

function adminNotificationTargetHtml(row) {
    var targetCount = parseInt(row && row.target_count ? row.target_count : 0, 10);
    if (targetCount > 0) {
        return '<div class="notify-target-number">' + adminNotificationEscape(targetCount) + '</div>' +
            '<div class="notify-muted">members</div>';
    }

    if (row && row.type === 'all') {
        return '<div class="notify-target-number">Broadcast</div>' +
            '<div class="notify-muted">all topic</div>';
    }

    return '<div class="notify-target-number">0</div>' +
        '<div class="notify-muted">members</div>';
}

function adminNotificationDateLabel(value) {
    if (!value) return '-';
    return String(value).length > 16 ? String(value).substring(0, 16) : String(value);
}

function adminNotificationsLoad() {
    var tbody = document.getElementById('admin-notification-tbody');
    var empty = document.getElementById('admin-notification-empty');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;color:var(--notify-ink-400);padding:28px;">Loading notifications...</td></tr>';
    }
    if (empty) empty.style.display = 'none';

    $.ajax({
        url: "<?php echo $pth; ?>View-List/Notification/admin_notification_list.php",
        type: "POST",
        dataType: "json",
        data: {
            page: adminNotificationPage,
            per_page: adminNotificationGetPerPage(),
            search: adminNotificationGetSearch(),
            audience: adminNotificationGetAudience(),
            sort: adminNotificationGetSort()
        },
        success: function(res) {
            if (!res || res.status !== 'success') {
                if (tbody) tbody.innerHTML = '';
                if (empty) empty.style.display = 'block';
                adminNotificationRenderPagination({ page: 1, total_pages: 1, total: 0 }, 0);
                return;
            }

            var rows = Array.isArray(res.notifications) ? res.notifications : [];
            adminNotificationRenderPagination(res.pagination, rows.length);

            if (!tbody) return;
            if (rows.length === 0) {
                tbody.innerHTML = '';
                if (empty) empty.style.display = 'block';
                return;
            }

            if (empty) empty.style.display = 'none';
            tbody.innerHTML = rows.map(function(row) {
                var created = adminNotificationDateLabel(row.sdt);
                var message = row.message || '';
                var imagePth = row.image_pth || '';
                var imageThumb = adminNotificationImageThumb(imagePth);

                return '<tr>' +
                    '<td data-label="Notification"><div class="notify-message-cell">' + imageThumb +
                    '<div class="notify-message-copy"><div class="notify-title-cell">' + adminNotificationEscape(row.title) + '</div>' +
                    '<div class="notify-muted">' + adminNotificationEscape(message.length > 140 ? message.substring(0, 140) + '...' : message) + '</div></div></div></td>' +
                    '<td data-label="Audience"><span class="notify-pill">' + adminNotificationEscape(adminNotificationAudienceLabel(row)) + '</span></td>' +
                    '<td data-label="Recipients">' + adminNotificationTargetHtml(row) + '</td>' +
                    '<td data-label="Created"><span class="notify-date">' + adminNotificationEscape(created) + '</span></td>' +
                    '</tr>';
            }).join('');
        },
        error: function(xhr) {
            if (tbody) tbody.innerHTML = '';
            if (empty) empty.style.display = 'block';
            adminNotificationRenderPagination({ page: 1, total_pages: 1, total: 0 }, 0);
            console.error('Notification list error:', xhr && xhr.responseText ? xhr.responseText : xhr);
        }
    });
}

if (typeof $ !== 'undefined') {
    $(document).ready(function() {
        if (document.getElementById('Main_Dashboard_06_A')) {
            adminNotificationsLoad();
        }
    });
}

window.adminNotificationEscape = adminNotificationEscape;
window.adminNotificationToast = adminNotificationToast;
window.adminNotificationShowList = adminNotificationShowList;
window.adminNotificationShowAdd = adminNotificationShowAdd;
window.adminNotificationReset = adminNotificationReset;
window.adminNotificationPreviewImage = adminNotificationPreviewImage;
window.adminNotificationSubmit = adminNotificationSubmit;
window.adminNotificationsSearchDelay = adminNotificationsSearchDelay;
window.adminNotificationsFilterChange = adminNotificationsFilterChange;
window.adminNotificationsPerPageChange = adminNotificationsPerPageChange;
window.adminNotificationsChangePage = adminNotificationsChangePage;
window.adminNotificationsLoad = adminNotificationsLoad;
</script>
