const { __ } = wp.i18n
const { useState } = wp.element;
const { Tooltip } = wp.components;
import "./scss/alignment.scss";
import Devices from "./Devices";

const IconControl = (props) => {

	const { value, responsive, onChange, label, content, options } = props;
	const [device, setDevice] = useState(() => window.usgrDevice || 'lg');
	const _filterValue = () => {
		return value ? (responsive ? (value[device]) : value) : '';
	}
	const [currentValue, setCurrentValue] = useState({ current: _filterValue() });

	const setSettings = (val) => {
		if (val == '') {
			return;
		}
		const final = responsive ? Object.assign({}, value, { [device]: val }) : val;
		onChange(final);
		setCurrentValue({ current: final });
	}
	const defaultData = options && Array.isArray(options) ? options : [];

	if (defaultData.length !== 0) {
		return (
			<div className="usgr-control-field components-base-control usgr-cf-alignment-wrap">

				{(label || responsive) && (
					<div className="usgr-cf-head">
						{label && (
							<span className="usgr-label">{label}</span>
						)}
						{responsive && <Devices device={device} onChange={_device => {
							setDevice(_device);
							const newData = JSON.parse(JSON.stringify(value));
							if (!newData[_device]) {
								newData[_device] = '';
							}
							onChange(newData)
						}}
						/>
						}
					</div>
				)}

				<div className="usgr-cf-body usgr-btn-group">
					{defaultData.map((data, index) => {
						return (
							<button className={(_filterValue() == data.value ? 'active' : '') + ' usgr-button'} key={index} onClick={() => setSettings(_filterValue() == data.value ? '' : data.value)}>
								<Tooltip text={__(data.label, 'user-grid')}><span className="usgr-align-icons">{__(data.icon, 'user-grid')}</span></Tooltip>
							</button>
						)
					})}
				</div>

			</div>
		)
	} else {
		return (
			<h5>{__('Component props options is mandatory', 'user-grid')}</h5>
		)
	}

}

export default IconControl;