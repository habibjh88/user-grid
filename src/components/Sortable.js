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
        console.log(label)

        onChange(newData);
    }
    return (
        <div className="components-base-control dowp-sortable-field">
            <div className="dowp-cf-head components-base-control__label">
                <span className="dowp-label">{label}</span>
            </div>
            <div className="dowp-cf-body">
                <DragSortableList items={list} onSort={onSort} dropBackTransitionDuration={0.1} type="vertical"/>
            </div>
        </div>
    )
}

export default Sortable;