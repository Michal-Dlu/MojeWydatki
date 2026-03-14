// resources/js/selectShortcut.js

document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('shop_name');
    if (!select) return; // jeśli nie ma selecta, nic nie robimy

    document.addEventListener('keydown', function(event) {
        const key = event.key.toLowerCase();

        for (let i = 0; i < select.options.length; i++) {
            const optionText = select.options[i].text.toLowerCase();
            if (optionText.startsWith(key)) {
                select.selectedIndex = i;
                select.focus();
                break;
            }
        }
    });
});