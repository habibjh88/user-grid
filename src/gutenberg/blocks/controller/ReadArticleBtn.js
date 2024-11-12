import {__} from "@wordpress/i18n";
import {useState} from '@wordpress/element';
import {PanelBody, Button, SelectControl, TextControl} from '@wordpress/components';
import {BUTTON_STYLE, NORMAL_HOVER} from "../../components/Constants";
import {Dimension, Color} from "../../components/Components";

export default function ReadArticleBtn(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    const [styleTab, setStyleTab] = useState('normal');
    //All attribute
    const {
        button_style,
        button_text,
        read_btn_spacing,
        read_btn_color,
        read_btn_bg,
        read_btn_color_hover,
        read_btn_bg_hover,
        border_color,
        border_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Read Articles Button', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Button Style", "user-grid")}
                className="usgr-control-field label-inline usgr-expand"
                value={button_style}
                options={BUTTON_STYLE}
                onChange={(button_style) => {
                    setAttributes({button_style})
                    changeQuery()
                }}
            />

            <TextControl
                autocomplete="off"
                help="Keep empty for hide the button."
                label={__("Button Text", "user-grid")}
                value={button_text}
                placeholder="Eg. @website.com, @inof.com etc"
                onChange={(button_text) => {
                    setAttributes({button_text})
                    changeQuery();
                }}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={read_btn_spacing}
                onChange={(value) => {
                    setAttributes({read_btn_spacing: value})
                }}
            />

            <div className="usgr-btn-hover-group">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={styleTab === item.value}
                        isSecondary={styleTab !== item.value}
                        onClick={() => setStyleTab(item.value)}
                    >
                        {item.label}
                    </Button>
                ))}
            </div>

            {'normal' === styleTab &&
                <>
                    <Color
                        label={__('Color', 'user-grid')}
                        color={read_btn_color}
                        onChange={(read_btn_color) => setAttributes({read_btn_color})}
                    />
                    <Color
                        label={__('Background Color', 'user-grid')}
                        color={read_btn_bg}
                        onChange={(read_btn_bg) => setAttributes({read_btn_bg})}
                    />
                    <Color
                        label={__('Border Color', 'user-grid')}
                        color={border_color}
                        onChange={(border_color) => setAttributes({border_color})}
                    />
                </>
            }

            {'hover' === styleTab &&
                <>
                    <Color
                        label={__('Color - Hover', 'user-grid')}
                        color={read_btn_color_hover}
                        onChange={(read_btn_color_hover) => setAttributes({read_btn_color_hover})}
                    />
                    <Color
                        label={__('Background Color - Hover', 'user-grid')}
                        color={read_btn_bg_hover}
                        onChange={(read_btn_bg_hover) => setAttributes({read_btn_bg_hover})}
                    />
                    <Color
                        label={__('Border Color - Hover', 'user-grid')}
                        color={border_color_hover}
                        onChange={(border_color_hover) => setAttributes({border_color_hover})}
                    />
                </>
            }

        </PanelBody>
    );
}
