function openAboutModal() {

    document.getElementById("aboutModalTitle").innerText = "Izmeni O nama";

    document.getElementById("aboutTitle").value = aboutData.title;
    document.getElementById("aboutShort").value = aboutData.short_description;
    document.getElementById("aboutLong").value = aboutData.long_description;
    document.getElementById("aboutMission").value = aboutData.mission;
    document.getElementById("aboutVision").value = aboutData.vision;

    document.getElementById("aboutModal").classList.remove("modal-hidden");
}

function closeAboutModal() {
    document.getElementById("aboutModal").classList.add("modal-hidden");
}
