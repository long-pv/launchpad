const range01 = document.getElementById("range01"),
	range02 = document.getElementById("range02"),
	range03 = document.getElementById("range03"),
	range04 = document.getElementById("range04"),
	range05 = document.getElementById("range05"),
	range1 = document.getElementById("range1"),
	range2 = document.getElementById("range2"),
	range3 = document.getElementById("range3"),
	range4 = document.getElementById("range4"),
	range5 = document.getElementById("range5"),
	currency = document.getElementById("currency"),
	major = document.getElementById("major"),
	saving = document.getElementById("saving"),
	p = document.getElementById("congrats");
var click = 0;
var usdRate = 23310;
var usdRate1 = usdRate * 10;
var major_selector = document.getElementById("major");
var majorElements = document.getElementsByClassName("major_tuition");
var termElements = document.getElementsByClassName("term");
var term1Elements = document.getElementsByClassName("term1");

var finaid_selector = document.getElementById("saving");
var finaidElements = document.getElementsByClassName("saving_amount");
var term_selector = document.getElementById("term");

var semesterFee = document.getElementsByClassName("total_sem");
var yearFee = document.getElementsByClassName("total_year");

var monthlivingFee = document.getElementsByClassName("month_living");
var semlivingFee = document.getElementsByClassName("sem_living");
var yearlivingFee = document.getElementsByClassName("year_living");

var totalLiving_sem = document.getElementsByClassName("total_living_sem");
var totalLiving_year = document.getElementsByClassName("total_living_year");
var Vinuni_fee_sem = document.getElementsByClassName("Vinuni_fee_sem");
var Vinuni_fee_year = document.getElementsByClassName("Vinuni_fee_year");
var sponsor_sem = document.getElementsByClassName("sponsor_sem");
var sponsor_year = document.getElementsByClassName("sponsor_year");

var el_tuition = majorElements[0];
var el_saving = finaidElements[0];
var el_term = termElements[0];
var el_term1 = term1Elements[0];

var semFee = semesterFee[0];
var yearFee = yearFee[0];
var monthlivingFee = monthlivingFee[0];
var semlivingFee = semlivingFee[0];
var yearlivingFee = yearlivingFee[0];
var totalLiving_sem = totalLiving_sem[0];
var totalLiving_year = totalLiving_year[0];
var Vinuni_sem = Vinuni_fee_sem[0];
var Vinuni_year = Vinuni_fee_year[0];
var sponsor_fee_sem = sponsor_sem[0];
var sponsor_fee_year = sponsor_year[0];

addCommas = (nStr) => {
	nStr += "";
	x = nStr.split(".");
	x1 = x[0];
	x2 = x.length > 1 ? "." + x[1] : "";
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, "$1" + "," + "$2");
	}
	return x1 + x2;
};

if (currency.value === "USD") {
	setValue = () => {
		const newValue01 = Number(((range01.value - range01.min) * 100) / (range01.max - range01.min));
		newPosition01 = 10 - newValue01 * 0.2;
		newValue02 = Number(((range02.value - range02.min) * 100) / (range02.max - range02.min));
		newPosition02 = 10 - newValue02 * 0.2;
		newValue03 = Number(((range03.value - range03.min) * 100) / (range03.max - range03.min));
		newPosition03 = 10 - newValue03 * 0.2;
		newValue04 = Number(((range04.value - range04.min) * 100) / (range04.max - range04.min));
		newPosition04 = 10 - newValue04 * 0.2;
		newValue05 = Number(((range05.value - range05.min) * 100) / (range05.max - range05.min));
		newPosition05 = 10 - newValue05 * 0.2;

		range1.innerHTML = `<span>${addCommas((Math.round(range01.value / usdRate1) * 10).toString())}</span>`;
		range1.style.left = `calc(${newValue01}% + (${newPosition01}px))`;
		range2.innerHTML = `<span>${addCommas((Math.round(range02.value / usdRate1) * 10).toString())}</span>`;
		range2.style.left = `calc(${newValue02}% + (${newPosition02}px))`;
		range3.innerHTML = `<span>${addCommas((Math.round(range03.value / usdRate1) * 10).toString())}</span>`;
		range3.style.left = `calc(${newValue03}% + (${newPosition03}px))`;
		range4.innerHTML = `<span>${addCommas((Math.round(range04.value / usdRate1) * 10).toString())}</span>`;
		range4.style.left = `calc(${newValue04}% + (${newPosition04}px))`;
		range5.innerHTML = `<span>${addCommas((Math.round(range05.value / usdRate1) * 10).toString())}</span>`;
		range5.style.left = `calc(${newValue05}% + (${newPosition05}px))`;
	};
} else if (currency.value === "VND") {
	setValue = () => {
		const newValue01 = Number(((range01.value - range01.min) * 100) / (range01.max - range01.min));
		newPosition01 = 10 - newValue01 * 0.2;
		newValue02 = Number(((range02.value - range02.min) * 100) / (range02.max - range02.min));
		newPosition02 = 10 - newValue02 * 0.2;
		newValue03 = Number(((range03.value - range03.min) * 100) / (range03.max - range03.min));
		newPosition03 = 10 - newValue03 * 0.2;
		newValue04 = Number(((range04.value - range04.min) * 100) / (range04.max - range04.min));
		newPosition04 = 10 - newValue04 * 0.2;
		newValue05 = Number(((range05.value - range05.min) * 100) / (range05.max - range05.min));
		newPosition05 = 10 - newValue05 * 0.2;

		range1.innerHTML = `<span>${addCommas(range01.value.toString())}</span>`;
		range1.style.left = `calc(${newValue01}% + (${newPosition01}px))`;
		range2.innerHTML = `<span>${addCommas(range02.value.toString())}</span>`;
		range2.style.left = `calc(${newValue02}% + (${newPosition02}px))`;
		range3.innerHTML = `<span>${addCommas(range03.value.toString())}</span>`;
		range3.style.left = `calc(${newValue03}% + (${newPosition03}px))`;
		range4.innerHTML = `<span>${addCommas(range04.value.toString())}</span>`;
		range4.style.left = `calc(${newValue04}% + (${newPosition04}px))`;
		range5.innerHTML = `<span>${addCommas(range05.value.toString())}</span>`;
		range5.style.left = `calc(${newValue05}% + (${newPosition05}px))`;
	};
}

document.addEventListener("DOMContentLoaded", setValue);
range01.addEventListener("input", setValue);
range02.addEventListener("input", setValue);
range03.addEventListener("input", setValue);
range04.addEventListener("input", setValue);
range05.addEventListener("input", setValue);
currency.onchange = function () {
	if (currency.value === "USD") {
		range1.innerHTML = `<span>${addCommas((Math.round(range01.value / usdRate1) * 10).toString())}</span>`;
		range2.innerHTML = `<span>${addCommas((Math.round(range02.value / usdRate1) * 10).toString())}</span>`;
		range3.innerHTML = `<span>${addCommas((Math.round(range03.value / usdRate1) * 10).toString())}</span>`;
		range4.innerHTML = `<span>${addCommas((Math.round(range04.value / usdRate1) * 10).toString())}</span>`;
		range5.innerHTML = `<span>${addCommas((Math.round(range05.value / usdRate1) * 10).toString())}</span>`;

		setValue = () => {
			const newValue01 = Number(((range01.value - range01.min) * 100) / (range01.max - range01.min));
			newPosition01 = 10 - newValue01 * 0.2;
			newValue02 = Number(((range02.value - range02.min) * 100) / (range02.max - range02.min));
			newPosition02 = 10 - newValue02 * 0.2;
			newValue03 = Number(((range03.value - range03.min) * 100) / (range03.max - range03.min));
			newPosition03 = 10 - newValue03 * 0.2;
			newValue04 = Number(((range04.value - range04.min) * 100) / (range04.max - range04.min));
			newPosition04 = 10 - newValue04 * 0.2;
			newValue05 = Number(((range05.value - range05.min) * 100) / (range05.max - range05.min));
			newPosition05 = 10 - newValue05 * 0.2;

			range1.innerHTML = `<span>${addCommas((Math.round(range01.value / usdRate1) * 10).toString())}</span>`;
			range1.style.left = `calc(${newValue01}% + (${newPosition01}px))`;
			range2.innerHTML = `<span>${addCommas((Math.round(range02.value / usdRate1) * 10).toString())}</span>`;
			range2.style.left = `calc(${newValue02}% + (${newPosition02}px))`;
			range3.innerHTML = `<span>${addCommas((Math.round(range03.value / usdRate1) * 10).toString())}</span>`;
			range3.style.left = `calc(${newValue03}% + (${newPosition03}px))`;
			range4.innerHTML = `<span>${addCommas((Math.round(range04.value / usdRate1) * 10).toString())}</span>`;
			range4.style.left = `calc(${newValue04}% + (${newPosition04}px))`;
			range5.innerHTML = `<span>${addCommas((Math.round(range05.value / usdRate1) * 10).toString())}</span>`;
			range5.style.left = `calc(${newValue05}% + (${newPosition05}px))`;
		};
	} else if (currency.value === "VND") {
		range1.innerHTML = `<span>${addCommas(range01.value.toString())}</span>`;
		range2.innerHTML = `<span>${addCommas(range02.value.toString())}</span>`;
		range3.innerHTML = `<span>${addCommas(range03.value.toString())}</span>`;
		range4.innerHTML = `<span>${addCommas(range04.value.toString())}</span>`;
		range5.innerHTML = `<span>${addCommas(range05.value.toString())}</span>`;

		setValue = () => {
			const newValue01 = Number(((range01.value - range01.min) * 100) / (range01.max - range01.min));
			newPosition01 = 10 - newValue01 * 0.2;
			newValue02 = Number(((range02.value - range02.min) * 100) / (range02.max - range02.min));
			newPosition02 = 10 - newValue02 * 0.2;
			newValue03 = Number(((range03.value - range03.min) * 100) / (range03.max - range03.min));
			newPosition03 = 10 - newValue03 * 0.2;
			newValue04 = Number(((range04.value - range04.min) * 100) / (range04.max - range04.min));
			newPosition04 = 10 - newValue04 * 0.2;
			newValue05 = Number(((range05.value - range05.min) * 100) / (range05.max - range05.min));
			newPosition05 = 10 - newValue05 * 0.2;

			range1.innerHTML = `<span>${addCommas(range01.value.toString())}</span>`;
			range1.style.left = `calc(${newValue01}% + (${newPosition01}px))`;
			range2.innerHTML = `<span>${addCommas(range02.value.toString())}</span>`;
			range2.style.left = `calc(${newValue02}% + (${newPosition02}px))`;
			range3.innerHTML = `<span>${addCommas(range03.value.toString())}</span>`;
			range3.style.left = `calc(${newValue03}% + (${newPosition03}px))`;
			range4.innerHTML = `<span>${addCommas(range04.value.toString())}</span>`;
			range4.style.left = `calc(${newValue04}% + (${newPosition04}px))`;
			range5.innerHTML = `<span>${addCommas(range05.value.toString())}</span>`;
			range5.style.left = `calc(${newValue05}% + (${newPosition05}px))`;
		};
	}

	document.addEventListener("DOMContentLoaded", setValue);
	range01.addEventListener("input", setValue);
	range02.addEventListener("input", setValue);
	range03.addEventListener("input", setValue);
	range04.addEventListener("input", setValue);
	range05.addEventListener("input", setValue);

	if (term.value === "sem") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas(setTuition(major).toString());
		}
		el_saving.innerHTML = addCommas(setAccom(saving).toString());
	} else if (term.value === "year") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas((setTuition(major) * 2).toString());
		}
		el_saving.innerHTML = addCommas((setAccom(saving) * 2).toString());
	}
};

savingPara = (val) => {
	if (val.value === "35") {
		return 0.65;
	} else if (val.value === "50") {
		return 0.5;
	} else if (val.value === "60") {
		return 0.4;
	} else if (val.value === "65") {
		return 0.35;
	} else if (val.value === "70") {
		return 0.3;
	} else if (val.value === "75") {
		return 0.25;
	} else if (val.value === "80") {
		return 0.2;
	} else if (val.value === "85") {
		return 0.15;
	} else if (val.value === "90") {
		return 0.1;
	} else if (val.value === "100" || val.value === "Full") {
		return 0;
	}
};

setAccom = (val) => {
	if (val.value === "Full") {
		return 0;
	} else {
		if (currency.value === "VND") {
			return 15000000;
		} else if (currency.value === "USD") {
			return Math.floor(15000000 / usdRate);
		}
	}
};

setStipend = (val) => {
	if (val.value === "Full") {
		if (currency.value === "VND") {
			return 5000000;
		} else if (currency.value === "USD") {
			return Math.floor(5000000 / usdRate);
		}
	} else {
		return 0;
	}
};

setTuition = (val) => {
	if (val.value === "NR") {
		if (currency.value === "VND") {
			return Math.floor((349650000 / 2) * savingPara(saving));
		} else if (currency.value === "USD") {
			return Math.floor((349650000 / (2 * usdRate)) * savingPara(saving));
		}
	} else if (
		val.value === "CS" ||
		val.value === "ME" ||
		val.value === "EE" ||
		val.value === "BA" ||
		val.value === "HM" ||
		val.value === "MD"
	) {
		if (currency.value === "VND") {
			return Math.floor((815850000 / 2) * savingPara(saving));
		} else if (currency.value === "USD") {
			return Math.floor((815850000 / (2 * usdRate)) * savingPara(saving));
		}
	} else {
		return 0;
	}
};

function updateTextView(_obj) {
	var num = getNumber(_obj.val());
	if (num == 0) {
		_obj.val("");
	} else {
		_obj.val(num.toLocaleString());
	}
}

function getNumber(_str) {
	var arr = _str.split("");
	var out = new Array();
	for (var cnt = 0; cnt < arr.length; cnt++) {
		if (isNaN(arr[cnt]) == false) {
			out.push(arr[cnt]);
		}
	}
	return Number(out.join(""));
}

function roundUp(num, precision) {
	precision = Math.pow(10, precision);
	return Math.ceil(num * precision) / precision;
}

major_selector.onchange = function () {
	// Show 65%, 75%, 85% options if major is NS
	if (major.value === "NR") {
		//Show/hide options
		$(".nr").show();
	} else {
		//Show/hide options
		$(".nr").hide();
	}
	saving.value = 35;
	if (term.value === "sem") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas(setTuition(major).toString());
		}
		el_saving.innerHTML = addCommas(setAccom(saving).toString());
	} else if (term.value === "year") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas((setTuition(major) * 2).toString());
		}
		el_saving.innerHTML = addCommas((setAccom(saving) * 2).toString());
	}
};

finaid_selector.onchange = function () {
	if (term.value === "sem") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas(setTuition(major).toString());
		}
		el_saving.innerHTML = addCommas(setAccom(saving).toString());
	} else if (term.value === "year") {
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas((setTuition(major) * 2).toString());
		}
		el_saving.innerHTML = addCommas((setAccom(saving) * 2).toString());
	}
};

term_selector.onchange = function () {
	if (term.value === "sem") {
		el_term.innerHTML = "Semester";
		el_term1.innerHTML = "Semester";
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas(setTuition(major).toString());
		}
		el_saving.innerHTML = addCommas(setAccom(saving).toString());
	} else if (term.value === "year") {
		el_term.innerHTML = "Year";
		el_term1.innerHTML = "Year";
		if (
			major.value === "CS" ||
			major.value === "ME" ||
			major.value === "EE" ||
			major.value === "BA" ||
			major.value === "HM" ||
			major.value === "MD" ||
			major.value === "NR"
		) {
			el_tuition.innerHTML = addCommas((setTuition(major) * 2).toString());
		}
		el_saving.innerHTML = addCommas((setAccom(saving) * 2).toString());
	}
};

let vinuniFee = setTuition(major) + setAccom(saving);
let livingFee =
	(parseInt(range01.value, 0) +
		parseInt(range02.value, 0) +
		parseInt(range03.value, 0) +
		parseInt(range04.value, 0)) *
	9;

function showDiv() {
	if (
		major.value === "CS" ||
		major.value === "ME" ||
		major.value === "EE" ||
		major.value === "BA" ||
		major.value === "HM" ||
		major.value === "MD" ||
		major.value === "NR"
	) {
		document.getElementById("hide1").style.display = "none";
		document.getElementById("hide").style.display = "block";
		semFee.innerHTML = addCommas((setTuition(major) + setAccom(saving) + click).toString());
		yearFee.innerHTML = addCommas(((setTuition(major) + setAccom(saving)) * 2).toString());
		if (currency.value === "VND") {
			if (major.value === "NR") {
				Vinuni_sem.innerHTML = addCommas(
					(
						(349650000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								4.5) /
						2
					).toString()
				);
				Vinuni_year.innerHTML = addCommas(
					(
						(349650000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
						1
					).toString()
				);
			} else {
				Vinuni_sem.innerHTML = addCommas(
					(
						(815850000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
						2
					).toString()
				);
				Vinuni_year.innerHTML = addCommas(
					(
						(815850000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
						1
					).toString()
				);
			}
			sponsor_fee_sem.innerHTML = addCommas(
				845850000 / 2 + setStipend(saving) / 2 - setAccom(saving) - setTuition(major)
			);
			sponsor_fee_year.innerHTML = addCommas(
				845850000 + setStipend(saving) - setAccom(saving) * 2 - setTuition(major) * 2
			);
			monthlivingFee.innerHTML = addCommas(
				Math.round(
					parseInt(range01.value, 0) +
						parseInt(range02.value, 0) +
						parseInt(range03.value, 0) +
						parseInt(range04.value, 0) +
						parseInt(range05.value, 0) -
						setStipend(saving) / 9
				).toString()
			);
			semlivingFee.innerHTML = addCommas(
				Math.round(
					(parseInt(range01.value, 0) +
						parseInt(range02.value, 0) +
						parseInt(range03.value, 0) +
						parseInt(range04.value, 0) +
						parseInt(range05.value, 0) -
						setStipend(saving) / 9) *
						4.5
				).toString()
			);
			yearlivingFee.innerHTML = addCommas(
				Math.round(
					(parseInt(range01.value, 0) +
						parseInt(range02.value, 0) +
						parseInt(range03.value, 0) +
						parseInt(range04.value, 0) +
						parseInt(range05.value, 0) -
						setStipend(saving) / 9) *
						9
				).toString()
			);
			totalLiving_sem.innerHTML = addCommas(
				(
					(parseInt(range01.value, 0) +
						parseInt(range02.value, 0) +
						parseInt(range03.value, 0) +
						parseInt(range04.value, 0) +
						parseInt(range05.value, 0)) *
						4.5 +
					setTuition(major) +
					setAccom(saving) -
					setStipend(saving) / 2
				).toString()
			);
			totalLiving_year.innerHTML = addCommas(
				(
					(parseInt(range01.value, 0) +
						parseInt(range02.value, 0) +
						parseInt(range03.value, 0) +
						parseInt(range04.value, 0) +
						parseInt(range05.value, 0)) *
						9 +
					setTuition(major) * 2 +
					setAccom(saving) * 2 -
					setStipend(saving)
				).toString()
			);
		} else if (currency.value === "USD") {
			if (major.value === "NR") {
				Vinuni_sem.innerHTML = addCommas(
					Math.round(
						(349650000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								4.5) /
							(2 * usdRate)
					).toString()
				);
				Vinuni_year.innerHTML = addCommas(
					Math.round(
						(349650000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
							usdRate
					).toString()
				);
			} else {
				Vinuni_sem.innerHTML = addCommas(
					Math.round(
						(815850000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
							(2 * usdRate)
					).toString()
				);
				Vinuni_year.innerHTML = addCommas(
					Math.round(
						(815850000 +
							30000000 +
							(parseInt(range01.value, 0) +
								parseInt(range02.value, 0) +
								parseInt(range03.value, 0) +
								parseInt(range04.value, 0) +
								parseInt(range05.value, 0)) *
								9) /
							usdRate
					).toString()
				);
			}
			sponsor_fee_sem.innerHTML = addCommas(
				Math.round(845850000 / (2 * usdRate) + setStipend(saving) - setAccom(saving) - setTuition(major))
			);
			sponsor_fee_year.innerHTML = addCommas(
				Math.round(845850000 / usdRate + setStipend(saving) - setAccom(saving) * 2 - setTuition(major) * 2)
			);
			monthlivingFee.innerHTML = addCommas(
				Math.round(
					parseInt(range01.value, 0) / usdRate +
						parseInt(range02.value, 0) / usdRate +
						parseInt(range03.value, 0) / usdRate +
						parseInt(range04.value, 0) / usdRate +
						parseInt(range05.value, 0) / usdRate -
						setStipend(saving) / 9
				).toString()
			);
			semlivingFee.innerHTML = addCommas(
				Math.round(
					(parseInt(range01.value, 0) / usdRate +
						parseInt(range02.value, 0) / usdRate +
						parseInt(range03.value, 0) / usdRate +
						parseInt(range04.value, 0) / usdRate +
						parseInt(range05.value, 0) / usdRate -
						setStipend(saving) / 9) *
						4.5
				).toString()
			);
			yearlivingFee.innerHTML = addCommas(
				Math.round(
					(parseInt(range01.value, 0) / usdRate +
						parseInt(range02.value, 0) / usdRate +
						parseInt(range03.value, 0) / usdRate +
						parseInt(range04.value, 0) / usdRate +
						parseInt(range05.value, 0) / usdRate -
						setStipend(saving) / 9) *
						9
				).toString()
			);
			totalLiving_sem.innerHTML = addCommas(
				Math.round(
					(parseInt(range01.value, 0) / usdRate +
						parseInt(range02.value, 0) / usdRate +
						parseInt(range03.value, 0) / usdRate +
						parseInt(range04.value, 0) / usdRate +
						parseInt(range05.value, 0) / usdRate) *
						4.5 +
						setTuition(major) +
						setAccom(saving) -
						setStipend(saving) / 2
				).toString()
			);
			totalLiving_year.innerHTML = addCommas(
				(
					Math.round(
						(parseInt(range01.value, 0) / usdRate +
							parseInt(range02.value, 0) / usdRate +
							parseInt(range03.value, 0) / usdRate +
							parseInt(range04.value, 0) / usdRate +
							parseInt(range05.value, 0) / usdRate) *
							9 +
							setTuition(major) * 2 +
							setAccom(saving) * 2
					) - setStipend(saving)
				).toString()
			);
		}
		if (currency.value === "VND") {
			$("#chart-area").remove(); // this is my <canvas> element
			$("#chart-container").append('<canvas id="chart-area" height = "400em"><canvas>');
			var ctx = document.getElementById("chart-area").getContext("2d");
			var myPie = new Chart(ctx, {
				type: "pie",
				data: {
					labels: ["Sponsored by VinUni", "Family Contribution"],
					datasets: [
						{
							backgroundColor: ["#2d5088", "#efb31f"],
							data: [
								845850000 - setAccom(saving) * 2 - setTuition(major) * 2 + setStipend(saving),
								(parseInt(range01.value, 0) +
									parseInt(range02.value, 0) +
									parseInt(range03.value, 0) +
									parseInt(range04.value, 0) +
									parseInt(range05.value, 0)) *
									9 +
									setAccom(saving) * 2 +
									setTuition(major) * 2 -
									setStipend(saving),
							],
							hoverBorderColor: ["#2d5088", "#efb31f"],
							hoverBorderWidth: 30,
						},
					],
				},

				options: {
					legend: {
						position: "bottom",
					},
					title: {
						display: true,
						fontStyle: "bold",
						fontSize: 20,
					},
					tooltips: {
						callbacks: {
							// this callback is used to create the tooltip label
							label: function (tooltipItem, data) {
								// get the data label and data value to display
								// convert the data value to local string so it uses a comma seperated number
								var dataLabel = data.labels[tooltipItem.index];
								var value =
									": " +
									data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString() +
									" VND - " +
									Math.round(
										(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] /
											((parseInt(range01.value, 0) +
												parseInt(range02.value, 0) +
												parseInt(range03.value, 0) +
												parseInt(range04.value, 0) +
												parseInt(range05.value, 0)) *
												9 +
												850000000)) *
											100
									).toLocaleString() +
									"%";

								// make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
								if (Chart.helpers.isArray(dataLabel)) {
									// show value on first line of multiline label
									// need to clone because we are changing the value
									dataLabel = dataLabel.slice();
									dataLabel[0] += value;
								} else {
									dataLabel += value;
								}
								// return the text to display on the tooltip
								return dataLabel;
							},
						},
					},
				},
			});

			p.textContent =
				"Congratulations, you have saved " +
				addCommas(845850000 - setAccom(saving) * 2 - setTuition(major) * 2 + setStipend(saving)) +
				" VND for your family!";
		} else if (currency.value === "USD") {
			$("#chart-area").remove(); // this is my <canvas> element
			$("#chart-container").append('<canvas id="chart-area" height = "400em"><canvas>');
			var ctx = document.getElementById("chart-area").getContext("2d");
			var myPie = new Chart(ctx, {
				type: "pie",
				data: {
					labels: ["Sponsored by VinUni", "Family Contribution"],
					datasets: [
						{
							backgroundColor: ["#2d5088", "#efb31f"],
							data: [
								Math.round(
									845850000 / usdRate -
										setAccom(saving) * 2 -
										setTuition(major) * 2 +
										setStipend(saving)
								),
								Math.round(
									(parseInt(range01.value, 0) / usdRate +
										parseInt(range02.value, 0) / usdRate +
										parseInt(range03.value, 0) / usdRate +
										parseInt(range04.value, 0) / usdRate +
										parseInt(range05.value, 0) / usdRate) *
										9 +
										setAccom(saving) * 2 +
										setTuition(major) * 2 -
										setStipend(saving)
								),
							],
							hoverBorderColor: ["#2d5088", "#efb31f"],
							hoverBorderWidth: 30,
						},
					],
				},

				options: {
					legend: {
						position: "bottom",
					},
					title: {
						display: true,
						fontStyle: "bold",
						fontSize: 20,
					},
					tooltips: {
						callbacks: {
							// this callback is used to create the tooltip label
							label: function (tooltipItem, data) {
								// get the data label and data value to display
								// convert the data value to local string so it uses a comma seperated number
								var dataLabel = data.labels[tooltipItem.index];
								var value =
									": " +
									data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString() +
									" USD - " +
									Math.round(
										(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] /
											((parseInt(range01.value, 0) / usdRate +
												parseInt(range02.value, 0) / usdRate +
												parseInt(range03.value, 0) / usdRate +
												parseInt(range04.value, 0) / usdRate +
												parseInt(range05.value, 0) / usdRate) *
												9 +
												850000000 / usdRate)) *
											100
									).toLocaleString() +
									"%";

								// make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
								if (Chart.helpers.isArray(dataLabel)) {
									// show value on first line of multiline label
									// need to clone because we are changing the value
									dataLabel = dataLabel.slice();
									dataLabel[0] += value;
								} else {
									dataLabel += value;
								}
								// return the text to display on the tooltip
								return dataLabel;
							},
						},
					},
				},
			});
			p.textContent =
				"Congratulations, you have saved " +
				addCommas(
					Math.round(845850000 / usdRate - setAccom(saving) * 2 - setTuition(major) * 2) + setStipend(saving)
				) +
				" USD for your family!";
		}
	} else {
		document.getElementById("hide1").style.display = "inline";
	}
}

// processing at the end and brought here for grouping
let x = document.querySelectorAll(".myDIV");
for (let i = 0, len = x.length; i < len; i++) {
	let num = Number(x[i].innerHTML).toLocaleString("en");
	x[i].innerHTML = num;
	x[i].classList.add("currSign");
}
