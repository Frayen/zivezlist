import React, { Component } from 'react';
import onClickOutside from "react-onclickoutside";

class Dropdown extends Component {
    constructor(props) {
        super(props);
        this.state = {
            selection: [],
            handleChange: props.onChange.bind(this),
        };
        this.options = props;
        this.toggle = false;
        this.multiple = false;
    }

    render() {
        return(
            <div className="alert-primary">
                <span>sdfsaf</span>
            </div>
        );
    }
}
export default Dropdown;