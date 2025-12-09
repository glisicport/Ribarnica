<div id="aboutModal" class="modal-hidden modal-overlay">

    <div class="modal-content">

        <div class="modal-header">
            <h3 id="aboutModalTitle">Izmeni O nama</h3>
            <button class="close-btn" onclick="closeAboutModal()">✕</button>
        </div>

        <form id="aboutForm" method="POST" enctype="multipart/form-data"
              action="{{ route('admin.about.update') }}">

            @csrf
            @method('PUT')

            <div class="modal-body">

                <label>Naslov *</label>
                <input type="text" name="title" id="aboutTitle" required class="modal-input">

                <label>Kratak opis *</label>
                <textarea name="short_description" id="aboutShort" rows="2" class="modal-input"></textarea>

                <label>Dugi opis *</label>
                <textarea name="long_description" id="aboutLong" rows="5" class="modal-input"></textarea>

                <label>Misija *</label>
                <textarea name="mission" id="aboutMission" rows="3" class="modal-input"></textarea>

                <label>Vizija *</label>
                <textarea name="vision" id="aboutVision" rows="3" class="modal-input"></textarea>

                <label>Slika</label>
                <input type="file" name="image" class="modal-input">

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-save">Sačuvaj</button>
                <button type="button" class="btn-cancel" onclick="closeAboutModal()">Otkaži</button>
            </div>

        </form>
    </div>

</div>
