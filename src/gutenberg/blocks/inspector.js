import ContentQuery from "./controller/ContentQuery";

const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentLayout from "./controller/ContentLayout";
import ContentControl from "./controller/ContentControl";
import FieldVisibility from "./controller/FieldVisibility";
import AvatarSettings from "./controller/AvatarSettings";
import NameSettings from "./controller/NameSettings";
import ShortDesc from "./controller/ShortDesc";
import BioSettings from "./controller/BioSettings";
import DesignationSettings from "./controller/DesignationSettings";
import SocialShareSettings from "./controller/SocialShareSettings";
import ReadArticleBtn from "./controller/ReadArticleBtn";
import CardSettings from "./controller/CardSettings";
import TabTitle from "../components/TabTitle";
import ContentSort from "./controller/ContentSort";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        avatar_visibility,
        name_visibility,
        designation_visibility,
        bio_visibility,
        social_visibility,
        short_desc_visibility,
        button_visibility
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
                                    <ContentLayout data={props} changeQuery={changeQuery} userData={userData}/>
                                    <ContentQuery data={props} changeQuery={changeQuery} userData={userData}/>
                                    <ContentSort data={props} changeQuery={changeQuery} userData={userData}/>
                                </>
                            )}

                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <FieldVisibility data={props} changeQuery={changeQuery}/>
                                    {avatar_visibility && <AvatarSettings data={props} changeQuery={changeQuery}/>}
                                    {name_visibility && <NameSettings data={props}/>}
                                    {short_desc_visibility && <ShortDesc data={props}/>}
                                    {designation_visibility && <DesignationSettings data={props}/>}
                                    {bio_visibility && <BioSettings data={props}/>}
                                    {social_visibility && <SocialShareSettings data={props}/>}
                                    {button_visibility && <ReadArticleBtn data={props} changeQuery={changeQuery}/>}
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