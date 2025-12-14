function openModal(modalId, formId, titleId, methodId, defaultAction, defaultTitle) {
    const modal = document.getElementById(modalId);
    const form = document.getElementById(formId);
    const title = document.getElementById(titleId);
    const method = document.getElementById(methodId);
    if (!modal || !form || !title || !method) return;

    form.reset();
    method.value = 'POST';
    title.textContent = defaultTitle;
    form.action = defaultAction;

    if (formId === 'productForm') {
        document.getElementById('productId').value = '';
        document.getElementById('productStock').value = 0;
        resetImagePreview();
    } else if (formId === 'categoryForm') {
        document.getElementById('categoryId').value = '';
        document.getElementById('categorySlug').dataset.manuallyEdited = 'false';
    }

    modal.classList.remove('modal-hidden');
    modal.classList.add('modal-visible');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.add('modal-hidden');
    modal.classList.remove('modal-visible');
}

function handleImagePreview(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('productImagePreview');
    if (!file) {
        resetImagePreview();
        return;
    }
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        alert('Dozvoljeni formati su: JPEG, PNG, WebP');
        event.target.value = '';
        resetImagePreview();
        return;
    }
    const maxSize = 20 * 1024 * 1024;
    if (file.size > maxSize) {
        alert('Veličina slike ne sme biti veća od 20MB. Trenutna veličina: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
        event.target.value = '';
        resetImagePreview();
        return;
    }
    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function resetImagePreview() {
    const preview = document.getElementById('productImagePreview');
    preview.src = '';
    preview.classList.add('hidden');
}

function showExistingImage(imagePath) {
    const preview = document.getElementById('productImagePreview');
    if (!imagePath || imagePath.trim() === '') {
        resetImagePreview();
        return;
    }
    preview.src = imagePath;
    preview.classList.remove('hidden');
}

function showPlaceholder() {
    resetImagePreview();
}

function openProductModal() {
    openModal('productModal', 'productForm', 'productModalTitle', 'productMethod', '/admin/products/', 'Novi Proizvod');
}

function closeProductModal() {
    closeModal('productModal');
}

function editProduct(id, name, price, description, categoryId, stock = 0, imagePath = null) {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    if (!modal || !form) return;
    if (!id || id === '') return alert('Greška: ID proizvoda nije pronađen');
    if (!name || name.trim() === '') return alert('Greška: Naziv proizvoda nije pronađen');

    document.getElementById('productId').value = id;
    document.getElementById('productName').value = name || '';
    document.getElementById('productPrice').value = price ?? '';
    document.getElementById('productDescription').value = description || '';
    document.getElementById('productCategory').value = categoryId || '';
    document.getElementById('productStock').value = stock ?? 0;
    document.getElementById('productMethod').value = 'PUT';
    document.getElementById('productModalTitle').textContent = 'Izmeni Proizvod';
    form.action = '/admin/products/' + id;

    modal.classList.remove('modal-hidden');
    modal.classList.add('modal-visible');

    setTimeout(function() {
        if (imagePath && imagePath.trim() !== '') {
            showExistingImage('/storage/' + imagePath);
        } else {
            showPlaceholder();
        }
    }, 100);
}

function openCategoryModal() {
    openModal('categoryModal', 'categoryForm', 'categoryModalTitle', 'categoryMethod', '/admin/categories/', 'Nova Kategorija');
}

function closeCategoryModal() {
    closeModal('categoryModal');
}

function editCategory(id, name, slug) {
    const modal = document.getElementById('categoryModal');
    const form = document.getElementById('categoryForm');
    if (!modal || !form) return;

    document.getElementById('categoryId').value = id;
    document.getElementById('categoryName').value = name || '';
    document.getElementById('categorySlug').value = slug || '';
    document.getElementById('categorySlug').dataset.manuallyEdited = 'true';
    document.getElementById('categoryMethod').value = 'PUT';
    document.getElementById('categoryModalTitle').textContent = 'Izmeni Kategoriju';
    form.action = '/admin/categories/' + id;

    modal.classList.remove('modal-hidden');
    modal.classList.add('modal-visible');
}

function generateSlug() {
    const nameInput = document.getElementById('categoryName');
    const slugInput = document.getElementById('categorySlug');

    if (!slugInput.dataset.manuallyEdited) {
        const slug = nameInput.value
            .toLowerCase()
            .replace(/ć/g, 'c')
            .replace(/č/g, 'c')
            .replace(/š/g, 's')
            .replace(/ž/g, 'z')
            .replace(/đ/g, 'd')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    }
}

function switchTab(tabName) {
    const tabContents = document.querySelectorAll('.tab-content');
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabContents.forEach(tab => tab.classList.add('hidden'));
    tabButtons.forEach(btn => {
        btn.classList.remove('tab-active');
        btn.classList.add('tab-inactive');
    });

    const activeTab = document.getElementById(tabName + '-tab');
    if (activeTab) activeTab.classList.remove('hidden');

    const activeBtn = document.querySelector('[data-tab="' + tabName + '"]');
    if (activeBtn) {
        activeBtn.classList.remove('tab-inactive');
        activeBtn.classList.add('tab-active');
    }
}

document.getElementById('categorySlug')?.addEventListener('input', function() {
    this.dataset.manuallyEdited = 'true';
});

document.getElementById('productForm')?.addEventListener('submit', function(e) {
    const name = document.getElementById('productName').value.trim();
    const price = document.getElementById('productPrice').value;
    const category = document.getElementById('productCategory').value;
    const stock = document.getElementById('productStock').value;

    if (!name) { e.preventDefault(); alert('Naziv proizvoda je obavezan!'); return false; }
    if (name.length < 3) { e.preventDefault(); alert('Naziv proizvoda mora imati najmanje 3 karaktera!'); return false; }
    if (!price || price <= 0) { e.preventDefault(); alert('Cena mora biti veća od 0!'); return false; }
    if (!category) { e.preventDefault(); alert('Molimo odaberite kategoriju!'); return false; }
    if (stock < 0) { e.preventDefault(); alert('Stanje ne može biti negativno!'); return false; }

    return true;
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProductModal();
        closeCategoryModal();
    }
});

document.getElementById('imageUploadContainer')?.addEventListener('click', function() {
    document.getElementById('productImage')?.click();
});

document.getElementById('productModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeProductModal();
});

document.getElementById('categoryModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeCategoryModal();
});
