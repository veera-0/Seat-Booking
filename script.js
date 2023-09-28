
const seatMap = document.getElementById("seat-map");
const form = document.getElementById("reservation-form");
const selectedSeatInput = document.getElementById("selected-seat");


const numRows = 9;
const numCols = 8;
const seats = new Array(numRows);

for (let i = 1; i <= numRows; i++) {
    seats[i] = new Array(numCols);
}


for (let row = 1; row <= numRows; row++) {
    for (let col = 1; col <= numCols; col++) {
        const seatNumber = String.fromCharCode(64+row)+col;
        const seat = document.createElement("div");
        seat.dataset.seat=seatNumber;
        seat.textContent=seatNumber;
        seat.classList.add("seat");
        seat.dataset.row = row;
        seat.dataset.col = col;
        seatMap.appendChild(seat);

        seat.addEventListener("click", (e) => {
            const selectedSeat = e.target;
            const row = selectedSeat.dataset.row;
            const col = selectedSeat.dataset.col;

            if (!selectedSeat.classList.contains("taken")) {
                selectedSeat.classList.toggle("selected");
                selectedSeatInput.value = `Row ${row}, Col ${col}`;
            } else {
                alert("This seat is already taken.");
            }
        });
    }
    seatMap.appendChild(document.createElement("br"));
}

seats[5][8]=true;
seats[9][8]=true;


for (let row = 1; row <= numRows; row++) {
    for (let col = 1; col <= numCols; col++) {
        if (seats[row][col]) {
            const seat = seatMap.querySelector(`[data-row="${row}"][data-col="${col}"]`);
            seat.classList.add("taken");
        }
    }
}
