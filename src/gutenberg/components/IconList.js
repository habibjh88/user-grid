import './scss/iconList.scss'

const {__} = wp.i18n
const {Component, Fragment} = wp.element
import IconListData from './assets/iconList'

class IconList extends Component {

    state = {
        isOpen: false,
        filterText: '',
        showIcons: false
    }

    render() {
        const {value, label, className} = this.props
        const {filterText, isOpen} = this.state
        let finalData = [];
        if (filterText.length > 2) {
            IconListData.forEach(name => {
                if (name.includes(filterText)) {
                    finalData.push(name)
                }
            })
        } else {
            finalData = IconListData;
        }

        const hasIcon = value ? 'has-icon' : '';

        return (
            <div className={`usgr-field components-base-control usgr-icon-main-wrapper ${className}`}>
                {this.props.label &&
                    <Fragment>
                        <label class="components-input-control__label">{label}</label>
                    </Fragment>
                }

                <div className={`icon-inner-wrapper`}>
                    {/*Remove button */}
                    {value && <span onClick={() => this.props.onChange('')}
                                    className="usgr-remove-icon dashicons dashicons-trash"/>}


                    <div className={`choose-icon ${hasIcon}`}
                         onClick={e => this.setState({isOpen: !this.state.isOpen})}
                    >
                        {/*Add Button*/}
                        {value ? <span className={`default-icon ${value}`}></span> :
                            <span className="dashicons dashicons-plus"/>}

                    </div>

                    {isOpen &&
                        <div className="usgr-icon-wrapper">
                            <span onClick={e => this.setState({isOpen: false})}
                                  className="usgr-remove-icon dashicons dashicons-no"/>
                            <input type="text" value={this.state.filterText} placeholder="Search..."
                                   onChange={e => this.setState({filterText: e.target.value})}
                                   autoComplete="off"/>
                            <div className="usgr-icon-list-icons">
                                {finalData.map(name => {
                                    return (<span className={value == name ? 'usgr-active' : ''}
                                                  onClick={e => {
                                                      this.props.onChange(name)
                                                      this.setState({isOpen: false})
                                                  }}><span className={name}/></span>)
                                })}
                            </div>
                        </div>
                    }
                </div>

            </div>
        )
    }
}

export default IconList