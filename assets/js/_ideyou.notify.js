const sounds = {
	ding: initAudio("ding.mp3"),
	slot: initAudio("slotmachine.wav"),
	cashin: initAudio("cashregister.mp3"),
	chimes: initAudio("chimes.mp3"),
	trash: initAudio("shredder.mp3"),
};

const IGNORE_LIST = ['request', 'data'];

$(function () {
	$(document).on('submit', 'form', function (e) {
		const ignore = e?.originalEvent?.submitter
			? $(e.originalEvent.submitter)?.attr("formaction") != undefined
			: false;

		if (ignore) return;

		const form = $(this).attr("class");
		const formData = $(this).serialize();
		const action = $(this).attr("action") ? $(this).attr("action") : "controller.php";

		const nSwal = $("#client-logo").length;
		const rForm = $("#notifyPlaceholder")[0] != null;

		$(".preloader").fadeIn(250);
		rForm && $("#notifyPlaceholder").html("");
		// console.log(`${form} [${action}] ==> `, formData);
		// $("[data-dismiss=modal]").trigger({ type: "click" });

		setTimeout(async () => {
			try {
				const data = await fetch(action, {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded" // Adjust as needed
					},
					body: `${form}=1&${formData}`
				});

				if (!data.ok) {
					Notify(`HTTP error! Status: ${data.status}`, 'danger');
					throw new Error(`HTTP error! Status: ${data.status}`);
				}

				const response = await data.json();

				$(".preloader").fadeOut(250);

				response?.forEach((element) => {
					if (IGNORE_LIST.includes(element.type))
						return console.log(`${element.type} => `, element);

					if (element.type === "print") {
						printOrder(null, element.message, element.redirect);
					} else {
						if (!rForm) {
							Notify(element.message, element.type, nSwal);
						} else {
							$("#notifyPlaceholder").removeClass("d-none");
							$("#notifyPlaceholder").append(
								`<div class="alert alert-${element.type}">${element.message}</div>`
							);
						}

						if (
							element.play &&
							cDevice.toLowerCase().indexOf("safari") != -1 &&
							cDevice.toLowerCase().indexOf("chrome") > -1
						) {
							const sound = sounds[element.play.toLowerCase()];
							sound.play();
							sound.onended = () => {
								setTimeout(
									() => {
										element.redirect === true
											? window.location.reload()
											: (location.href = element.redirect);
									},
									nSwal ? 2250 : element.type == "success" ? 100 : 1000
								);
							};
							sound.onerror = () => {
								Notify("Error playing a sound...", "danger");
								if (element.redirect) {
									element.redirect === true
										? window.location.reload()
										: (location.href = element.redirect);
								}
							};
						} else {
							element.play && sounds[element.play.toLowerCase()].play();
							element.redirect &&
								setTimeout(
									() => {
										element.redirect === true
											? window.location.reload()
											: (location.href = element.redirect);
									},
									nSwal || element.play
										? 2250
										: element.type == "success"
											? 100
											: 1000
								);
						}
					}
				});
			} catch (error) {
				// console.error("error => ", error);
				// console.debug(`${form} [${action}] ==> `, formData);

				if (!rForm) {
					Notify(
						"Desculpe, ocorreu um erro inesperado ao processar sua solicitação. Por favor, entre em contato conosco!",
						"warning"
					);
				} else {
					$("#notifyPlaceholder").append(
						`<div class="alert alert-warning">Desculpe, ocorreu um erro inesperado ao processar sua solicitação. Por favor, entre em contato conosco!</div>`
					);
				}
			}
		}, 300);

		return false;
	});
});
