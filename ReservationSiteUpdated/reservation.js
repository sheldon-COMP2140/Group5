class Reservation {
    constructor(item, date) {
        this.item = item; // Item being reserved
        this.date = date; // Date of the reservation
        this.date.reserve(this.date); // Reserve the date
    
    }

    //change the date of a previously made reservation
    changeDate(newdate){

        if(this.date.reserve()){
            this.date.cancel();
            this.date = newdate
            return true;

        }

        return false; //returns false if the new proposed date is already reserved.
    }

}

class DateReserve {
    constructor(dateStr) {
        this.dateStr = dateStr; // Store the date as a string (e.g., "2024-12-25")
        this.isReservedFlag = false; // Flag to indicate whether this date is reserved
    }
    
    // Mark the date as reserved
    // Reserve a specific date
    reserve() {
        if (this.isReservedFlag == true) {
            return false; // If the date is already reserved, return false
        }
        this.isReservedFlag = true; // Mark the date as reserved
        return true;
    }
    
    // Mark the date as unreserved (for cancellation)
    cancel() {
        this.isReservedFlag = false;
    }
    
    // Check if the date is reserved
    isReserved() {
        return this.isReservedFlag;
    }
}

// Item class
class Item {
    constructor(name) {
        this.name = name; // Item name
    }

    getItemName(){

        return this.name
    }

    
}






