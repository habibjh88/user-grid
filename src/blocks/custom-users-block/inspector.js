const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentControl from "./controller/ContentControl";
import FieldVisibility from "./controller/FieldVisibility";
import AvatarSettings from "./controller/AvatarSettings";
import NameSettings from "./controller/NameSettings";
import ShortDesc from "./controller/ShortDesc";
import BioSettings from "./controller/BioSettings";
import DesignationSettings from "./controller/DesignationSettings";
import SocialShareSettings from "./controller/SocialShareSettings";
import CardSettings from "./controller/CardSettings";
import TabTitle from "../../components/TabTitle";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        avatar_visibility,
        name_visibility,
        email_visibility,
        bio_visibility,
        social_visibility,
        short_desc_visibility
    } = attributes;


    return (
        <InspectorControls key="controls">
            <div className="dowp-panel-control-wrapper">
                <TabPanel className="dowp-tab-panel" activeClass="active-tab" tabs={[
                    {
                        name: "content",
                        title: <TabTitle title={`Content`} icon={`dashicons-edit`}/>,
                        className: "dowp-tab-btn content",
                    },
                    {
                        name: "styles",
                        title: <TabTitle title={`Settings / Styles`} icon={`dashicons-admin-generic`}/>,
                        className: "dowp-tab-btn settings",
                    }
                ]}
                >
                    {(tab) => (
                        <div className="dowp-tab-content">

                            {/* Content Tab*/}
                            {tab.name === "content" && (
                                <>
                                    <ContentControl data={props} changeQuery={changeQuery} userData={userData}/>
                                </>
                            )}

                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <FieldVisibility data={props} changeQuery={changeQuery}/>
                                    {avatar_visibility && <AvatarSettings data={props} changeQuery={changeQuery}/>}
                                    {name_visibility && <NameSettings data={props}/>}
                                    {short_desc_visibility && <ShortDesc data={props}/>}
                                    {email_visibility && <DesignationSettings data={props}/>}
                                    {bio_visibility && <BioSettings data={props}/>}
                                    {social_visibility && <SocialShareSettings data={props}/>}
                                    <CardSettings data={props}/>
                                </>
                            )}
                        </div>
                    )}
                </TabPanel>
            </div>
        </InspectorControls>
    )
}

export default Inspector;