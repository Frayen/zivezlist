import {DropdownComponent} from './_dropdown.js';

class DropdownFilter extends DropdownComponent {
    constructor(props) {
        super(props);
    }

    onChange(){
        console.log("2");
    }
}

export default DropdownFilter;