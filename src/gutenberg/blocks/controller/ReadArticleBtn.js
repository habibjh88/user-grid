import {useState} from '@wordpress/element';
import {
    PanelBody, ButtonGroup, Button
} from '@wordpress/components';
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import RangeDevice from "../../components/RangeDevice";
import {NORMAL_HOVER} from "../../components/Constants";
import {__} from "@wordpress/i18n";

export default function ReadArticleBtn(props) {
    const {attributes, setAttributes} = props.data;
    const [styleTab, setStyleTab] = useState('normal');
    //All attribute
    const {
        read_btn_spacing,
        read_btn_color,
        read_btn_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Read Articles Button', 'user-grid')} initialOpen={false}>

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={read_btn_spacing}
                onChange={(value) => {
                    setAttributes({read_btn_spacing: value})
                }}
            />

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
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
            </ButtonGroup>

            {'normal' === styleTab &&
                <Color
                    label={__('Color', 'user-grid')}
                    color={read_btn_color}
                    onChange={(read_btn_color) => setAttributes({read_btn_color})}
                />
            }

            {'normal' === styleTab &&
                <Color
                    label={__('Color - Hover', 'user-grid')}
                    color={read_btn_color_hover}
                    onChange={(read_btn_color_hover) => setAttributes({read_btn_color_hover})}
                />
            }

        </PanelBody>
    );
}
