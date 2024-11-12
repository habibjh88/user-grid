const {__} = wp.i18n
import './scss/media.scss'

const {Component} = wp.element;
const {MediaUpload} = wp.blockEditor;
export const {Tooltip, Dashicon} = wp.components;

class Media extends Component {

    setSettings(media) {
        const {multiple, onChange, value} = this.props
        if (multiple) {
            let medias = [];
            media.forEach(single => {
                if (single && single.url) {
                    medias.push({url: single.url, id: single.id});
                }
            });
            onChange(value ? value.concat(medias) : medias);
        } else {
            if (media && media.url) {
                onChange({url: media.url, id: media.id});
            }
        }
    }

    removeImage(id) {
        const {multiple, onChange} = this.props
        if (multiple) {
            let value = (this.props.value).slice()
            value.splice(id, 1)
            onChange(value)
        } else {
            onChange({})
        }
    }

    isUrl(url) {
        if (['wbm', 'jpg', 'jpeg', 'gif', 'png', 'svg'].indexOf(url.split('.').pop().toLowerCase()) != -1) {
            return url;
        } else {
            return usgrParams.plugin_url + 'assets/images/usgr-placeholder.png';
        }
    }

    render() {
        const {type, multiple, value, panel, video} = this.props;
        return (
            <div className='usgr-media'>
                {this.props.label &&
                    <label>{this.props.label}</label>
                }
                <MediaUpload
                    onSelect={val => this.setSettings(val)}
                    allowedTypes={type.length ? [...type] : ['image']}
                    multiple={multiple || false}
                    value={value}
                    render={({open}) => (
                        <div className="usgr-single-img">
                            <div>
                                {multiple ?
                                    <div>
                                        {(value.length > 0) &&
                                            value.map((v, index) => {
                                                return (
                                                    <span className="usgr-media-image-parent">
														<img src={this.isUrl(v.url)} alt={__('image')}/>
                                                        {panel &&
                                                            <div
                                                                className="usgr-media-actions usgr-field-button-list">
                                                                <Tooltip text={__('Edit')}>
                                                                    <button className="usgr-button"
                                                                            aria-label={__('Edit')} onClick={open}
                                                                            role="button">
                                                                        <span aria-label={__('Edit')}
                                                                              className="dashicons dashicons-edit-large"/>
                                                                    </button>
                                                                </Tooltip>
                                                                <Tooltip text={__('Remove')}>
                                                                    <button className="usgr-button"
                                                                            aria-label={__('Remove')}
                                                                            onClick={() => this.removeImage(index)}
                                                                            role="button">
                                                                        <span aria-label={__('Close')}
                                                                              className="dashicons dashicons-trash"/>
                                                                    </button>
                                                                </Tooltip>
                                                            </div>
                                                        }
													</span>
                                                )
                                            })
                                        }
                                        <div onClick={open} className={"usgr-placeholder-image"}>
                                            <div className="dashicon dashicons dashicons-insert"/>
                                            <div>{__('Insert')}</div>
                                        </div>
                                    </div>
                                    :
                                    ((value && value.url) ?
                                            <span className="usgr-media-image-parent">
											{
                                                video ?
                                                    <video controls autoPlay loop src={value.url}/>
                                                    :
                                                    <img src={this.isUrl(value.url)} alt={__('image')}/>
                                            }

                                                {panel &&
                                                    <div className="usgr-media-actions usgr-field-button-list">
                                                        <Tooltip text={__('Edit')}>
                                                            <button className="usgr-button" aria-label={__('Edit')}
                                                                    onClick={open} role="button">
                                                                <span aria-label={__('Edit')}
                                                                      className="dashicons dashicons-edit-large"/>
                                                            </button>
                                                        </Tooltip>
                                                        <Tooltip text={__('Remove')}>
                                                            <button className="usgr-button"
                                                                    aria-label={__('Remove')}
                                                                    onClick={() => this.removeImage(value.id)}
                                                                    role="button">
                                                                <span aria-label={__('Close')}
                                                                      className="dashicons dashicons-trash"/>
                                                            </button>
                                                        </Tooltip>
                                                    </div>
                                                }
										</span>
                                            :
                                            <div onClick={open} className={"usgr-placeholder-image"}>
                                                <div className="dashicon dashicons dashicons-insert"/>
                                                <div>{__('Insert')}</div>
                                            </div>
                                    )
                                }
                            </div>
                        </div>
                    )}
                />
            </div>
        );
    }
}

export default Media;