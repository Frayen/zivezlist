import React, {Component} from 'react';
import onClickOutside from 'react-onclickoutside';

class Dropdown extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            options: props.options,
            value: props.value,
            title: props.title,
            multiSelect: props.multiSelect,
            selection: [],
            open: false,
        }
    }

    handleClickOutside() {this.setState({open: false})}
    isItemInSelection(option) {return this.state.selection.find(current => current.id === option.id)}
    toggle(open) {this.setState({open: open})}

    componentDidUpdate(prevProps, prevState) {
        if (!this.arrayIsSame(prevState.selection, this.state.selection)) {
            this.onChange();
        }
    }

    onChange() {
        console.log("1");
    }

    arrayIsSame(a, b) {
        return Array.isArray(a) &&
            Array.isArray(b) &&
            a.length === b.length &&
            a.every((val, index) => val === b[index]);
    }


    handleOnclick (option) {
        if (!this.state.selection.some(current => current.id === option.id)){
            if (!this.state.multiSelect) {
                this.setState({selection: [option]});
            } else if (this.state.multiSelect) {
                this.setState({selection: [...this.state.selection, option]});
            }
        } else {
            let selectionAfterRemoval = this.state.selection;
            selectionAfterRemoval = selectionAfterRemoval.filter(
                current => current.id !== option.id
            );
            this.setState({selection:[...selectionAfterRemoval]})
        }
        this.toggle(this.state.open)
    }

    clearSelect() {
        this.setState({selection: []});
    }

    clearDeleteToggle () {
        if (this.state.selection.length !== 0) {
            return (<span className="ti-close" onClick={() => this.clearSelect()}></span>);
        } else {
            if (!open) {
                return (<span className="ti-angle-down"></span>);
            } else {
                return (<span className="ti-angle-up"></span>);
            }
        }
    }

    renderValue() {
        if (this.state.selection.length !== 0) {
            if (!this.state.multiSelect) {
                return (this.state.selection[0].name);
            } else if (this.multiSelect) {
                return("");
            }
        } else {
            return(this.state.title);
        }

    }

    render() {
        return (
            <div className="dd-wrapper">
                <div tabIndex={0}
                     className="dd-header"
                     role="button"
                     onKeyPress={() => this.toggle(!this.state.open)}
                     onClick={() => {this.toggle(!this.state.open)}}
                >
                    <div className="dd-header__title">
                        <span className="dd-header__title--bold">{this.renderValue()}</span>
                        {this.clearDeleteToggle(open)}
                    </div>

                </div>
                {this.state.open && (
                    <ul className="dd-list">
                        {this.state.options.map(option => (
                            <li className="dd-list-item" key={option.id}>
                                <button type="button" onClick={() => this.handleOnclick(option)}>
                                    <span>{option.name}</span>
                                    {this.isItemInSelection(option) && (<span className="ti-check"></span>)}
                                </button>
                            </li>
                        ))}
                    </ul>
                )}
            </div>
        );
    }
}

export const DropdownComponent = onClickOutside(Dropdown);
