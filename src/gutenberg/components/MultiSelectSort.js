import Devices from "./Devices";

const {useState, useEffect} = wp.element;

import Select, {components} from "react-select";
import {
    SortableContainer,
    SortableElement,
    sortableHandle
} from "react-sortable-hoc";

function arrayMove(array, from, to) {
    array = array.slice();
    array.splice(to < 0 ? array.length + to : to, 0, array.splice(from, 1)[0]);
    return array;
}

const SortableMultiValue = SortableElement((props) => {
    const onMouseDown = (e) => {
        e.preventDefault();
        e.stopPropagation();
    };
    const innerProps = {...props.innerProps, onMouseDown};
    return <components.MultiValue {...props} innerProps={innerProps}/>;
});

const SortableMultiValueLabel = sortableHandle((props) => (
    <components.MultiValueLabel {...props} />
));

const SortableSelect = SortableContainer(Select);

export default function MultiSelectSort({
                                            options,
                                            value,
                                            onChange,
                                            closeMenuOnSelect,
                                            isClearable,
                                            label = '',
                                            isSingleLine = false
                                        }) {

    const changeHandle = (selectedOptions) => onChange(selectedOptions);
    // const changeHandle = (selectedOptions) => setSelected(selectedOptions);

    const onSortEnd = ({oldIndex, newIndex}) => {
        const newValue = arrayMove(value, oldIndex, newIndex);
        onChange(newValue);
    };

    return (
        <div
            className={`dowp-control-field components-base-control dowp-react-multiselect ${isSingleLine ? 'should-single-line' : ''}`}>
            {label &&
                <div className="dowp-cf-head">
                    <span className="dowp-label">{label}</span>
                </div>
            }
            <div className="dowp-cf-body">
                <SortableSelect
                    className={`dowp-sortable-react-select`}
                    useDragHandle
                    // react-sortable-hoc props:
                    axis="xy"
                    onSortEnd={onSortEnd}
                    distance={4}
                    // small fix for https://github.com/clauderic/react-sortable-hoc/pull/352:
                    getHelperDimensions={({node}) => node.getBoundingClientRect()}
                    // react-select props:
                    isMulti
                    isClearable={isClearable}
                    options={options}
                    value={value}
                    onChange={changeHandle}
                    components={{
                        MultiValue: SortableMultiValue,
                        MultiValueLabel: SortableMultiValueLabel
                    }}
                    closeMenuOnSelect={closeMenuOnSelect}
                    styles={{
                        singleValue: (base) => ({
                            ...base,
                            padding: 5,
                            borderRadius: 5,
                            background: red,
                            color: 'white',
                            display: 'flex',
                            flex: '1',
                        }),
                    }}
                />
            </div>
        </div>
    );
}
