import DragSortableList from 'react-drag-sortable'


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function Sortable(props) {
    const {label, value, onChange = []} = props;
    const list = value.map(function (item) {
        return {content: (<div>{capitalizeFirstLetter(item.replace('_', ' '))}</div>), name: item}
    })
    var onSort = function (sortedList, event) {
        const newData = sortedList.map(item => {
            return item.name;
        })
        onChange(newData);
    }

    return (
        <div className="components-base-control usgr-sortable-field">
            <div className="usgr-cf-head components-base-control__label">
                <span className="usgr-label">{label}</span>
            </div>
            <div className="usgr-cf-body">
                <DragSortableList items={list} onSort={onSort} dropBackTransitionDuration={0.1} type="vertical"/>
            </div>
        </div>
    )
}

export default Sortable;