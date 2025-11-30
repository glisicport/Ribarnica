function openProductModal() {
    document.getElementById('productForm').reset();
    document.getElementById('productMethod').value = 'POST';
    document.getElementById('productId').value = '';
    document.getElementById('productModalTitle').textContent = 'Novi Proizvod';
    document.getElementById('productForm').action = '/admin/products/';
    document.getElementById('productModal').classList.remove('modal-hidden');
    document.getElementById('productModal').classList.add('modal-visible');
}

function closeProductModal() {
    document.getElementById('productModal').classList.add('modal-hidden');
    document.getElementById('productModal').classList.remove('modal-visible');
}

function editProduct(id, name, price, description, categoryId) {
    document.getElementById('productId').value = id;
    document.getElementById('productName').value = name;
    document.getElementById('productPrice').value = price;
    document.getElementById('productDescription').value = description;
    document.getElementById('productCategory').value = categoryId;
    document.getElementById('productMethod').value = 'PUT';
    document.getElementById('productModalTitle').textContent = 'Izmeni Proizvod';
    document.getElementById('productForm').action = '/admin/products/' + id;
    document.getElementById('productModal').classList.remove('modal-hidden');
    document.getElementById('productModal').classList.add('modal-visible');
}

function openCategoryModal() {
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryMethod').value = 'POST';
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryModalTitle').textContent = 'Nova Kategorija';
    document.getElementById('categoryForm').action = '/admin/categories/';
    document.getElementById('categoryModal').classList.remove('modal-hidden');
    document.getElementById('categoryModal').classList.add('modal-visible');
}

function closeCategoryModal() {
    document.getElementById('categoryModal').classList.add('modal-hidden');
    document.getElementById('categoryModal').classList.remove('modal-visible');
}

function editCategory(id, name, slug) {
    document.getElementById('categoryId').value = id;
    document.getElementById('categoryName').value = name;
    document.getElementById('categorySlug').value = slug;
    document.getElementById('categorySlug').dataset.manuallyEdited = 'true';
    document.getElementById('categoryMethod').value = 'PUT';
    document.getElementById('categoryModalTitle').textContent = 'Izmeni Kategoriju';
    document.getElementById('categoryForm').action = '/admin/categories/' + id;
    document.getElementById('categoryModal').classList.remove('modal-hidden');
    document.getElementById('categoryModal').classList.add('modal-visible');
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
    
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    const activeBtn = document.querySelector('[data-tab="' + tabName + '"]');
    activeBtn.classList.remove('tab-inactive');
    activeBtn.classList.add('tab-active');
}

document.getElementById('categorySlug')?.addEventListener('input', function() {
    this.dataset.manuallyEdited = 'true';
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProductModal();
        closeCategoryModal();
    }
});

document.getElementById('productModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeProductModal();
    }
});

document.getElementById('categoryModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeCategoryModal();
    }
});