import {__} from "@wordpress/i18n";
import {PanelBody} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";

function JobRole(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        job_role_typography,
        job_role_spacing,
        job_role_color,
    } = attributes;

    return (
        <PanelBody title={__('Job Role', 'user-grid')} initialOpen={false}>


            <Typography
                label={__('Typography')}
                value={job_role_typography}
                onChange={(val) => setAttributes({job_role_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={job_role_spacing}
                onChange={(value) => {
                    setAttributes({job_role_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={job_role_color}
                onChange={(job_role_color) => setAttributes({job_role_color})}
            />

        </PanelBody>
    );
}

export default JobRole;
