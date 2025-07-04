document.addEventListener('DOMContentLoaded', function() {
    const regions = document.querySelectorAll('.calculator__region-select.select-region');
    
    regions.forEach(function(region) {
        const valueSpan = region.querySelector('.select-region__value');
        const options = region.querySelectorAll('.select-region__option');

        region.addEventListener('click', function(e) {
            e.stopPropagation();
            region.classList.toggle('open');
        });

        options.forEach(function(option) {
            option.addEventListener('click', function(e) {
                e.stopPropagation();
                const regionName = option.textContent.trim();
                const regionId = option.getAttribute('data-value');
                
                valueSpan.textContent = regionName;
                region.classList.remove('open');
                
                const event = new CustomEvent('regionSelected', {
                    detail: { id: regionId, name: regionName }
                });
                region.dispatchEvent(event);
            });
        });
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.calculator__region-select.select-region')) {
            regions.forEach(r => r.classList.remove('open'));
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            regions.forEach(r => r.classList.remove('open'));
        }
    });
});