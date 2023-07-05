//プロフィール詳細表示関係
function openModal(id) {
    const url = "/getprofile";
    const data = { id: id };
    const headers = {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
            .querySelector("[name='csrf-token']")
            .getAttribute("content"),
    };
    fetch(url, {
        method: "POST",
        headers: headers,
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Fetch failed");
            }
            return response.json();
        })
        .then((res) => {
            document.getElementById("nickname").innerHTML = res.nickname;
            document.getElementById("hobby").innerHTML = res.hobby;
            document.getElementById("firstdrink").innerHTML = res.firstdrink;
            var assetBaseUrl = "{{ asset('') }}";
            document.getElementById("icon").src = assetBaseUrl + res.icon;
            console.log(assetBaseUrl + res.icon);
            var fullIconUrl = assetBaseUrl + res.icon;
            document.getElementById("icon").src = fullIconUrl;
                console.log("Full icon URL:", fullIconUrl);

            const drinks = [
                "生ビール",
                "瓶ビール",
                "ノンアルコールビール",
                "ハイボール",
                "レモンサワー",
                "ウーロンハイ",
                "緑茶ハイ",
                "烏龍茶",
                "コーラ",
                "ジンジャーエール",
                "その他",
            ];
            let drink = res.firstdrink;
            if (drink >= 0 && drink < drinks.length) {
                console.log(drinks[drink]);
                document.getElementById("firstdrink").textContent =
                    drinks[drink];
            }
        })
        .catch((error) => {
            alert("Fetch error");
        });
    const modalContainer = document.querySelector(".modal-container");
    modalContainer.style.display = "flex";
    modalContainer.classList.remove("opacity-0", "invisible");
    modalContainer.classList.add("opacity-100", "visible");
}
document.querySelector(".modal-close").addEventListener("click", function () {
    const modalContainer = document.querySelector(".modal-container");
    modalContainer.style.display = "none";
    modalContainer.classList.add("opacity-0", "invisible");
    modalContainer.classList.remove("opacity-100", "visible");
});

document.addEventListener("DOMContentLoaded", function () {
    const closeModal = document.querySelector(".modal-close");
    // モーダルを閉じる
    closeModal.addEventListener("click", function () {
        const modalContainer = document.querySelector(".modal-container");
        modalContainer.style.display = "none";
        modalContainer.classList.remove("opacity-100", "visible");
        modalContainer.classList.add("opacity-0", "invisible");
    });
});
